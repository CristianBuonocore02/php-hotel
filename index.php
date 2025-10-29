<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>hotel</title>
</head>
<style>
    td,
    th {
        padding: 0.75rem 1rem;
        border: 1px solid;
        text-align: center;
    }

    h1 {
        text-align: center;
        font-family: Georgia, 'Times New Roman', Times, serif;
        margin-top: 2rem;
    }
</style>

<body>
    <?php

    $hotels = [
        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],
    ];

    ?>

    <h1>Hotels</h1>

    <form method="GET" class="container mt-4 mb-4">
        <div class="row g-3 align-items-center justify-content-center">
            <div class=" form-control">
                <label for="parking" class="form-label">Solo con parcheggio:</label>
                <input type="checkbox" for="parking" name="parking" id="parking" value="1"
                    <?php if (isset($_GET['parking'])) echo 'checked'; ?>>
            </div>

            <div class="form-control">
                <label for="vote" class="form-label">Voto minimo:</label>
                <input type="number" name="vote" id="vote" class="form-control" min="1" max="5"
                    value="<?php echo $_GET['vote'] ?? ''; ?>">
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filtra</button>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>


    <table class="mt-5 m-auto">
        <thead>
            <tr class="border">
                <th>Nome</th>
                <th>Descrizione</th>
                <th>Parcheggio</th>
                <th>Voto</th>
                <th>Distanza dal centro</th>
            </tr>
        </thead>
        <tbody>

            <?php

            // Applica i filtri se sono stati inviati
            // Inizializza i filtri
            $parking_requested = false;
            $minVote = 0;

            // Controlla se l'utente ha selezionato il checkbox del parcheggio
            if (isset($_GET['parking']) && $_GET['parking'] == "1") {
                $parking_requested = true;
            }

            // Controlla se l'utente ha inserito un voto minimo
            if (!empty($_GET['vote'])) {
                $minVote = (int) $_GET['vote'];
            }

            // Applica i filtri
            $filteredHotels = array_filter($hotels, function ($hotel) use ($parking_requested, $minVote) {
                // Filtro parcheggio
                if ($parking_requested && !$hotel['parking']) {
                    return false;
                }

                // Filtro voto minimo
                if ($hotel['vote'] < $minVote) {
                    return false;
                }

                // Se passa entrambi i filtri
                return true;
            });

            // Mostra gli hotel filtrati
            foreach ($filteredHotels as $hotel) {


            ?>
                <tr class="border">
                    <td><?php echo $hotel['name'] ?></td>
                    <td><?php echo $hotel['description'] ?></td>
                    <td><?php echo $hotel['parking'] ? 'Sì' : 'No'; ?></td>
                    <td><?php echo $hotel['vote'] ?></td>
                    <td><?php echo $hotel['distance_to_center'] ?></td>
                </tr>

            <?php
            }
            ?>

        </tbody>
    </table>


</body>

</html>