//chaîne de connexion dans le code de votre application
mongodb+srv://root:root@cluster0.qyuka7b.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0


<?php
/* use MongoDB\Driver\ServerApi;

$uri = 'mongodb+srv://root:root@cluster0.qyuka7b.mongodb.net/Ecoride?retryWrites=true&w=majority&appName=Cluster0';
mongodb+srv://root:root@cluster0.qyuka7b.mongodb.net/EcoRide?retryWrites=true&w=majority

// Set the version of the Stable API on the client
$apiVersion = new ServerApi(ServerApi::V1);

// Create a new client and connect to the server
$client = new MongoDB\Client($uri, [], ['serverApi' => $apiVersion]);

try {
    // Send a ping to confirm a successful connection
    $client->selectDatabase('admin')->command(['ping' => 1]);
    echo "Pinged your deployment. You successfully connected to MongoDB!\n";
} catch (Exception $e) {
    printf($e->getMessage());
} */