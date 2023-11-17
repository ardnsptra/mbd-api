<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

    //======================================================================================================

    // == get 
    // kabupaten
    $app->get('/kabupaten', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL Read_Kabupaten()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    // tenaga kesehatan
    $app->get('/tenagakesehatan', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL Read_TenagaKesehatan()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    // non tenaga kesehatan
    $app->get('/nontenagakesehatan', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL Read_NonTenagaKesehatan()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    // jumlah
    $app->get('/jumlah', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL Read_Jumlah()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    // persen tenaga kesehatan
    $app->get('/persentenagakesehatan', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL Read_PersenTenagaKesehatan()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });


    //======================================================================================================


    // == get by id
    // kabupaten
    $app->get('/kabupaten/{id}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Kabupaten_ByID(:id)');
        $query->execute(['id' => $args['id']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    // tenaga kesehatan
    $app->get('/tenagakesehatan/{ID}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_TenagaKesehatan_ByID(:ID)');
        $query->execute(['ID' => $args['ID']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    // non tenaga kesehatan
    $app->get('/nontenagakesehatan/{ID}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_NonTenagaKesehatan_ByID(:ID)');
        $query->execute(['ID' => $args['ID']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    // jumlah
    $app->get('/jumlah/{ID}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Jumlah_ByID(:ID)');
        $query->execute(['ID' => $args['ID']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    // persen tenaga kesehatan
    $app->get('/persentenagakesehatan/{ID}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_PersenTenagaKesehatan_ByID(:ID)');
        $query->execute(['ID' => $args['ID']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    //======================================================================================================

    // == post data
    // kabupaten
    $app->post('/kabupaten', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $id = $parsedBody["id"];
        $nama = $parsedBody["nama"];

        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Insert_Kabupaten(:id, :nama)');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':nama', $nama, PDO::PARAM_STR);

        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Data di tambahkan'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    });

    // tenaga kesehatan
    $app->post('/tenagakesehatan', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $id_kabupaten = $parsedBody["id_kabupaten"];
        $jumlah_tk = $parsedBody["jumlah_tk"];

        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Insert_TenagaKesehatan(:id_kabupaten, :jumlah_tk)');
        $query->bindParam(':id_kabupaten', $id_kabupaten, PDO::PARAM_INT);
        $query->bindParam(':jumlah_tk', $jumlah_tk, PDO::PARAM_STR);

        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Data di tambahkan'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    });

    // non tenaga kesehatan
    $app->post('/nontenagakesehatan', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $id_kabupaten = $parsedBody["id_kabupaten"];
        $jumlah_nontk = $parsedBody["jumlah_nontk"];

        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Insert_NonTenagaKesehatan(:id_kabupaten, :jumlah_nontk)');
        $query->bindParam(':id_kabupaten', $id_kabupaten, PDO::PARAM_INT);
        $query->bindParam(':jumlah_nontk', $jumlah_nontk, PDO::PARAM_STR);

        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Data di tambahkan'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    });

    // jumlah
    $app->post('/jumlah', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $id_kabupaten = $parsedBody["id_kabupaten"];

        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Insert_Jumlah(:id_kabupaten, @total)');
        $query->bindParam(':id_kabupaten', $id_kabupaten, PDO::PARAM_INT);
        $query->execute();

        // Fetch the result from the output parameter
        $totalQuery = $db->query('SELECT @total as total');
        $total = $totalQuery->fetch(PDO::FETCH_ASSOC)['total'];

        $response->getBody()->write(json_encode(
            [
                'message' => 'Total populasi: ' . $total
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    });

    // persen tenaga kesehatan
    $app->post('/persentenagakesehatan', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $id_kabupaten = $parsedBody["id_kabupaten"];

        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Insert_PersenTenagaKesehatan(:id_kabupaten, @rata_rata)');
        $query->bindParam(':id_kabupaten', $id_kabupaten, PDO::PARAM_INT);
        $query->execute();

        $rataRataQuery = $db->query('SELECT @rata_rata as rata_rata');
        $rata_rata = $rataRataQuery->fetch(PDO::FETCH_ASSOC)['rata_rata'];

        $response->getBody()->write(json_encode(
            [
                'message' => 'Persentase tenaga kesehatan: ' . $rata_rata . '%'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    });


    //======================================================================================================

    // == put data
    // kabupaten
    $app->put('/kabupaten/{id}', function (Request $request, Response $response, $args) {
        $parsedBody = $request->getParsedBody();
        
        $id = $args['id'];
        $nama = $parsedBody["nama"];
    
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Update_Kabupaten_ByID(:id, :nama)');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->bindParam(':nama', $nama, PDO::PARAM_STR);
            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data kabupaten dengan ID ' . $id . ' telah diperbarui'
                ]
            ));
        } catch (PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode([
                'message' => 'Terdapat error pada database ' . $e->getMessage()
            ]));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });
    
    // tenaga kesehatan
    $app->put('/tenagakesehatan/{id}', function (Request $request, Response $response, $args) {
        $parsedBody = $request->getParsedBody();
    
        $id = $args['id'];
        $jumlah_tk = $parsedBody["jumlah_tk"];
    
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Update_TenagaKesehatan_ByID(:id, :jumlah_tk)');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->bindParam(':jumlah_tk', $jumlah_tk, PDO::PARAM_INT);
            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data tenagakesehatan dengan ID ' . $id . ' telah diperbarui'
                ]
            ));
        } catch (PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode([
                'message' => 'Terdapat error pada database ' . $e->getMessage()
            ]));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });

    // non tenaga kesehatan
    $app->put('/nontenagakesehatan/{id}', function (Request $request, Response $response, $args) {
        $parsedBody = $request->getParsedBody();
    
        $id = $args['id'];
        $jumlah_nontk = $parsedBody["jumlah_nontk"];
    
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Update_NonTenagaKesehatan_ByID(:id, :jumlah_nontk)');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->bindParam(':jumlah_nontk', $jumlah_nontk, PDO::PARAM_INT);
            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data nontenagakesehatan dengan ID ' . $id . ' telah diperbarui'
                ]
            ));
        } catch (PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode([
                'message' => 'Terdapat error pada database ' . $e->getMessage()
            ]));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });

    // jumlah
    $app->put('/jumlah/{id}', function (Request $request, Response $response, $args) {
        $id = $args['id'];
    
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Update_Jumlah_ByID(:id)');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data jumlah dengan ID ' . $id . ' telah diperbarui'
                ]
            ));
        } catch (PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode([
                'message' => 'Terdapat error pada database ' . $e->getMessage()
            ]));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });
    
    

    // persen tenaga kesehatan
    $app->put('/persentenagakesehatan/{id}', function (Request $request, Response $response, $args) {
        $id = $args['id'];
    
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Update_PersenTenagaKesehatan_ByID(:id)');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data persentasetenagakesehatan dengan ID ' . $id . ' telah diperbarui'
                ]
            ));
        } catch (PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode([
                'message' => 'Terdapat error pada database ' . $e->getMessage()
            ]));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });
    
    
    //======================================================================================================

    // delete data
    // kabupaten
    $app->delete('/kabupaten/{id}', function (Request $request, Response $response, $args) {
        $currentId = $args['id'];
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Delete_Kabupaten_ByID(:id)');
            $query->bindParam(':id', $currentId, PDO::PARAM_INT);
            $query->execute();
    
            if ($query->rowCount() === 0) {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data tidak ditemukan'
                    ]
                ));
            } else {
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data dengan ID ' . $currentId . ' telah dihapus dari database'
                    ]
                ));
            }
        } catch (PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Database error ' . $e->getMessage()
                ]
            ));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });

    // TENAGA KESEHATAN
    $app->delete('/tenagakesehatan/{id}', function (Request $request, Response $response, $args) {
        $currentId = $args['id'];
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Delete_TenagaKesehatan_ByID(:id)');
            $query->bindParam(':id', $currentId, PDO::PARAM_INT);
            $query->execute();
    
            if ($query->rowCount() === 0) {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data tidak ditemukan'
                    ]
                ));
            } else {
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data dengan ID ' . $currentId . ' telah dihapus dari database'
                    ]
                ));
            }
        } catch (PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Database error ' . $e->getMessage()
                ]
            ));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });

    // non tenaga kesehatan
    $app->delete('/nontenagakesehatan/{id}', function (Request $request, Response $response, $args) {
        $currentId = $args['id'];
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Delete_NonTenagaKesehatan_ByID(:id)');
            $query->bindParam(':id', $currentId, PDO::PARAM_INT);
            $query->execute();
    
            if ($query->rowCount() === 0) {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data tidak ditemukan'
                    ]
                ));
            } else {
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data dengan ID ' . $currentId . ' telah dihapus dari database'
                    ]
                ));
            }
        } catch (PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Database error ' . $e->getMessage()
                ]
            ));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });

    // jumlah
    $app->delete('/jumlah/{id}', function (Request $request, Response $response, $args) {
        $currentId = $args['id'];
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Delete_Jumlah_ByID(:id)');
            $query->bindParam(':id', $currentId, PDO::PARAM_INT);
            $query->execute();
    
            if ($query->rowCount() === 0) {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data tidak ditemukan'
                    ]
                ));
            } else {
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data dengan ID ' . $currentId . ' telah dihapus dari database'
                    ]
                ));
            }
        } catch (PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Database error ' . $e->getMessage()
                ]
            ));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });

    // persen  tenaga kesehatan
    $app->delete('/persentenagakesehatan/{id}', function (Request $request, Response $response, $args) {
        $currentId = $args['id'];
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Delete_PersenTenagaKesehatan_ByID(:id)');
            $query->bindParam(':id', $currentId, PDO::PARAM_INT);
            $query->execute();
    
            if ($query->rowCount() === 0) {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data tidak ditemukan'
                    ]
                ));
            } else {
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data dengan ID ' . $currentId . ' telah dihapus dari database'
                    ]
                ));
            }
        } catch (PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Database error ' . $e->getMessage()
                ]
            ));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });
};
