// Sélection de l'élément d'input pour la ville
let input = document.querySelector("#city");

// Ajout d'un écouteur d'événement pour l'événement 'input'
input.addEventListener('input', function () {
    // Vérification si la valeur de l'input a une longueur de 5 caractères
    if (this.value.length == 5) {
        // Construction de l'URL de l'API avec le code postal saisi
        let url = `https://geo.api.gouv.fr/communes?codePostal=${this.value}&type=commune-actuelle&fields=nom,code,codesPostaux&format=json&geometry=centre`;

        // Requête Fetch pour obtenir les données des communes
        fetch(url)
            .then(response => response.json())
            .then(data => {
                // Construction de la liste des communes
                let list = "<ul class='list-group'>";
                for (let ville of data) {
                    list += `<li class='list-group-item'><button type='button' class='btn btn-link city-link'>${ville.nom}</button></li>`;
                }
                list += '</ul>';

                // Affichage de la liste des communes dans un élément avec la classe 'city_list'
                document.querySelector(".city_list").innerHTML = list;

                // Sélection de tous les boutons de la classe 'city-link'
                const links = document.querySelectorAll('.city-link');
                links.forEach(link => {
                    // Ajout d'un écouteur d'événement pour chaque bouton de commune
                    link.addEventListener('click', function () {
                        const cityName = this.textContent;
                        const inputCodePostal = document.querySelector('#city');

                        // Remplace le contenu de l'input par le nom de la ville sélectionnée
                        inputCodePostal.value = cityName;
                    });
                });
            })

            .catch(error => {
                console.error(error);
                // Affichage d'un message d'erreur en cas d'échec de la requête
                document.querySelector(".city_list").innerHTML = "<div class='alert alert-danger'>Erreur lors du chargement des villes.</div>";
            });
    }
});