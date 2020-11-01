<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.2.1/dt-1.10.16/datatables.min.js"></script>
<link href="/vendor/jQuery-Plugin-For-Sortable-Bootstrap-Tables-Bootstrap-Sortable/Contents/bootstrap-sortable.css" rel="stylesheet" type="text/css">

<script src="/vendor/jQuery-Plugin-For-Sortable-Bootstrap-Tables-Bootstrap-Sortable/Scripts/bootstrap-sortable.js"></script>
<script src="/ajouts.js"></script>
<?php

$table = "livre";


$sql = "select * from $table";

$dbhost = $_ENV["DBHOST"];
$database = $_ENV["DATABASE"];
$dbuser = $_ENV["DBUSER"];
$dbpassword = $_ENV["DBPASSWORD"];

if (empty($dbhost) || empty($database) || empty($dbuser) || empty($dbpassword) ) {
    echo 'Missing environment variables: you need to set DBHOST, DATABASE, DBUSER and DBPASSWORD';
    exit();
}

$conn = new mysqli($dbhost, $dbuser, $dbpassword,$database);
// check connection
if ($conn->connect_error) {
    echo 'Unable to connect to DB. Error: '  . $conn->connect_error;
    exit();
}

$rs = $conn->query($sql);

if($rs === false) {
    echo "Unable to retrieve data: ".$conn->error;
} else {
    $rs->data_seek(0);
    $row = $rs->fetch_row();
}

?>

<html>
<head>
<title>Livre</title>
</head>
<body>
<div class="modal-content">
    <div class="modal-body">
        <form>
            <div class="form-label">
                <label for="titre">Titre</label><br />
            </div>		
            <div class="form-label">
                <label for="auteur">Auteur</label><br />
            </div>
            <div class="form-label">
                <label for="genre">Genre</label><br />
            </div>					
        </form>
    </div>
    <div class="modal-footer">
        <div id="boutonSave">
            <button type="button" class="btn btn-primary" onclick="ajouterLivre()">Enregistrer</button>
        </div>
    </div>
</div>


<table class="table sortable" id="tableBook">
    <thead>
        <tr>
            <th> Titre</th>
            <th> Auteur</th>
            <th> Genre</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($rs as $livre) {
            echo "<td>$livre->titre</td>";
            echo "<td>$livre->auteur</td>";
            echo "<td>$livre->genre</td>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<script tpye="teste/javascript">
$(document).ready(function () {
    $('#tableBook').DataTable(
		{
            "language":
                {
                    "decimal": "",
                    "emptyTable": "Aucune de donnée disponible",
                    "info": "Page _START_ sur _END_ avec _TOTAL_ lignes",
                    "infoEmpty": "Page 0 sur 0 avec 0 ligne",
                    "infoFiltered": "(filttré sur _MAX_ lignes)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Afficher _MENU_ lignes",
                    "loadingRecords": "Chargement ...",
                    "processing": "Chargement ...",
                    "search": "Rechercher :",
                    "zeroRecords": "Aucune donnée trouvée",
                    "paginate": {
                        "first": "Premier",
                        "last": "Dernier",
                        "next": "Suivant",
                        "previous": "Précédent"
                    },
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                }
        }
	);    
});
</script>