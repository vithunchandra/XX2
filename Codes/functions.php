<?php 
    session_start();
    $connector = mysqli_connect("localhost", "root", "", "T7_221116998", "3306");
    
    function fetchData($query){
        global $connector;
        $rawData = mysqli_query($connector, $query);
        $data = [];
        while($row = mysqli_fetch_assoc($rawData)){
            $data[] = $row;
        }

        return $data;
    }

    function insertIntoUser($user){
        global $connector;

        $username = $user['username'];
        $email = $user['email'];
        $name = $user['name'];
        $password = $user['password'];

        $query = "INSERT INTO user(name, username, email, password) VALUES('$name', '$username', '$email', '$password')";
        mysqli_query($connector, $query);

        return mysqli_affected_rows($connector);
    }

    function deleteFromUser($user){
        global $connector;

        $query = "UPDATE ownership o JOIN marketplace m ON m.ownership_id = o.id
        SET m.status = 0, o.status = 0 WHERE o.user_id = '$user'";
        mysqli_query($connector, $query);

        $query = "UPDATE user SET status = 0 WHERE id = '$user'";
        mysqli_query($connector, $query);

        return mysqli_affected_rows($connector);
    }

    function insertToIpo($data){
        global $connector;

        $asset = $data['asset'];
        $market = $data['market'];
        $price = $data['price'];

        $query = "INSERT INTO ipo(market, asset, price, last_price, low, high) VALUES('$market', '$asset', '$price', '$price', '$price', '$price')";
        mysqli_query($connector, $query);
        
        $assetID = fetchData("SELECT id FROM ipo ORDER BY id DESC LIMIT 1")[0]['id'];

        $userData = fetchData("SELECT id FROM user");
        foreach($userData as $key => $value){
            $userID = $value['id'];
            $query = "INSERT INTO ownership(user_id, asset_id, quantity) VALUES('$userID', '$assetID', '20')";
            mysqli_query($connector, $query);
        }

        return mysqli_affected_rows($connector);
    }

    function insertIntoMarketplace($data){
        global $connector;

        $id = $data['identifier'];
        $price = $data['price'];
        $quantity = $data['quantity'];

        $query = "INSERT INTO marketplace(ownership_id, price, quantity) VALUES('$id', '$price', '$quantity')";
        mysqli_query($connector, $query);

        return mysqli_affected_rows($connector);
    }

    function sellOwnership($identifier, $quantity){
        global $connector;

        $have = fetchData("SELECT quantity FROM ownership WHERE id = '$identifier'")[0]['quantity'];
        if($have >= $quantity){
            $query = "UPDATE ownership SET quantity = quantity - $quantity  WHERE id = '$identifier'";
        }
        mysqli_query($connector, $query);
    
        $query = "UPDATE ownership SET status = CASE WHEN quantity <= 0 THEN 0 ELSE status END WHERE id = '$identifier'";
        mysqli_query($connector, $query);

        return mysqli_affected_rows($connector);
    }

    function deleteOwnership($userID, $assetID){
        global $connector;

        $query = "DELETE FROM ownership WHERE user_id = '$userID' AND asset_id = '$assetID'";
        mysqli_query($connector, $query);

        return mysqli_affected_rows($connector);
    }

    function buyOwnership($identifier, $buyerID){
        global $connector;

        $market = fetchData("SELECT o.asset_id AS asset_id, m.price AS price, m.quantity AS quantity 
        FROM marketplace m JOIN ownership o ON o.id = m.ownership_id WHERE m.id = '$identifier'")[0];
        $assetID = $market['asset_id'];
        $quantity = $market['quantity'];
        $price = $market['price'];
        $totalPrice = (int)$market['price'] * (int)$market['quantity'];

        $buyerWallet = fetchData("SELECT wallet FROM user WHERE id = '$buyerID'")[0]['wallet'];

        if($buyerWallet >= $totalPrice){
            $sellerID = fetchData("SELECT user_id FROM ownership o JOIN marketplace m ON m.ownership_id = o.id WHERE m.id = '$identifier'")[0]['user_id'];
            echo $buyerID."-".$sellerID;

            $query = "UPDATE user SET wallet = wallet - $totalPrice WHERE id = '$buyerID'";
            mysqli_query($connector, $query);
    
            $query = "UPDATE user SET wallet = wallet + $totalPrice WHERE id = '$sellerID'";
            mysqli_query($connector, $query);

            $query = "UPDATE ownership SET quantity = quantity + $quantity, status = 1 WHERE user_id = '$buyerID' AND asset_id = '$assetID'";
            mysqli_query($connector, $query);

            if(mysqli_affected_rows($connector) <= 0){
                $query = "INSERT INTO ownership(user_id, asset_id, quantity) VALUES('$buyerID', '$assetID', '$quantity')";
                mysqli_query($connector, $query);
            }

            $query = "UPDATE ipo 
            SET low = CASE WHEN low > '$price' THEN '$price' ELSE low END, 
            high = CASE WHEN high < '$price' THEN '$price' ELSE high END, 
            last_price = '$price' WHERE id = '$assetID'";
            mysqli_query($connector, $query);
    
            $query = "UPDATE marketplace SET buyer_id = '$buyerID', status = '0' WHERE id = '$identifier'";
            mysqli_query($connector, $query);

            return true;
        }else{
            echo "<script>alert('Saldo tidak cukup');</script>";
            return false;
        }
    }

    function cancelListing($identifier){
        global $connector;

        $totalSheets = fetchData("SELECT quantity FROM marketplace WHERE id = '$identifier'")[0]['quantity'];
        $ownership = fetchData("SELECT o.id AS id FROM marketplace m JOIN ownership o ON o.id = m.ownership_id WHERE m.id = '$identifier'")[0];
        $ownershipID = $ownership['id'];

        $query = "UPDATE ownership SET status = CASE WHEN status = 0 THEN 1 ELSE status END, quantity = '$totalSheets' 
        + quantity WHERE id = '$ownershipID'";
        mysqli_query($connector, $query);

        $query = "UPDATE marketplace SET status = 0 WHERE id = '$identifier'";
        mysqli_query($connector, $query);

        return mysqli_affected_rows($connector);
    }

    function isUserExist($username, $email){
        if($username == "admin" || $email == "admin"){
            return true;
        }

        $userData = fetchData("SELECT * FROM user");
        foreach($userData as $key => $value){
            if($value['username'] == $username || $value['email'] == $email){
                return true;
            }
        }

        return false;
    }

    function login($username){
        $userData = fetchData("SELECT * FROM user");

        foreach($userData as $key => $value){
            if($value['username'] == $username || $value['email'] == $username){
                return $value;
            }
        }

        return null;
    }

    function validateUser($role){
        if(!isset($_SESSION['userID']) && empty($_SESSION['userID'])){
            header("Location: index.php");
        }
        if($role != $_SESSION['role']){
            if($_SESSION['role'] == "admin"){
                header("Location: admin.php");
            }else{
                header("Location: userhome.php");
            }
        }
    }

    function logout(){
        unset($_SESSION);
        header("Location: index.php");
    }
?>