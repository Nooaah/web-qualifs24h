$(document).ready(function () {
    document.getElementById('vehiculeRenduButton').addEventListener('click', function () {
        var script = document.createElement('script');
        script.src = 'deleteTieFighterResa.php?id=' + document.getElementById('vehiculeRenduButton').dataset.id;
        document.body.appendChild(script);
    })
    document.getElementById('vehiculeSupprimerButton').addEventListener('click', function () {
        var script = document.createElement('script');
        script.src = 'deleteTieFighter.php?id=' + document.getElementById('vehiculeSupprimerButton').dataset.id;
        document.body.appendChild(script);
    })
    document.getElementById('vehiculeDonnerButton').addEventListener('click', function () {
        var script = document.createElement('script');
        script.src = 'addResa.php?id=' + document.getElementById('vehiculeDonnerButton').dataset.id + '&stormtrooper=' + document.getElementById('vehiculeDonnerButton').dataset.idstormtrooper;
        document.body.appendChild(script);
    })
});

