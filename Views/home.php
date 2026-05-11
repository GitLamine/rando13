<section id="hero" class="hero-section py-5">
    <div class="container">
        <div class="hero-panel row align-items-center gx-5">
            <div class="col-lg-7">
                <span class="hero-badge">Bouches-du-Rhône · Département 13</span>
                <h1>Découvrez et partagez les plus belles randonnées du 13</h1>
                <p class="hero-copy">Calanques, Sainte-Victoire, Luberon, Alpilles — partagez vos parcours avec la communauté du 13.</p>
                <div class="hero-actions mt-4">
                    <a href="index.php?action=articles" class="btn btn-primary btn-lg">Explorer les randos</a>
                    <a href="index.php?action=add_article" class="btn btn-outline-light btn-lg">Partager la mienne</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hero-stats-card p-4">
                    <div class="row text-center gy-3">
                        <div class="col">
                            <p class="hero-stat-number">247</p>
                            <p class="hero-stat-label">Randonnées partagées</p>
                        </div>
                        <div class="col">
                            <p class="hero-stat-number">83</p>
                            <p class="hero-stat-label">Randonneurs</p>
                        </div>
                        <div class="col">
                            <p class="hero-stat-number">12</p>
                            <p class="hero-stat-label">Massifs couverts</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="featured-section py-5">
    <div class="container">
        <div class="section-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
            <div>
                <span class="section-label">À la une</span>
                <h2>Dernières randonnées</h2>
            </div>
            <a href="index.php?action=articles" class="btn btn-outline-light btn-sm">Voir tout</a>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <article class="feature-card p-4">
                    <div class="feature-card-top d-flex justify-content-between align-items-start mb-3">
                        <span class="feature-badge badge-easy">Facile</span>
                        <span class="feature-tag">Calanques</span>
                    </div>
                    <h3>Calanque de Sormiou</h3>
                    <ul class="feature-meta list-unstyled mb-3">
                        <li>8 km · 320 m · 2h30</li>
                        <li>Parcours ombragé, accès facile au lever du soleil.</li>
                    </ul>
                    <div class="feature-footer d-flex justify-content-between align-items-center">
                        <small class="text-muted">LamineRando</small>
                        <span class="feature-views">312 vues</span>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <article class="feature-card p-4">
                    <div class="feature-card-top d-flex justify-content-between align-items-start mb-3">
                        <span class="feature-badge badge-hard">Difficile</span>
                        <span class="feature-tag">Sainte-Victoire</span>
                    </div>
                    <h3>Crête de Sainte-Victoire</h3>
                    <ul class="feature-meta list-unstyled mb-3">
                        <li>18 km · 1100 m · 7h</li>
                        <li>Ascension technique avec panorama exceptionnel sur la Provence.</li>
                    </ul>
                    <div class="feature-footer d-flex justify-content-between align-items-center">
                        <small class="text-muted">MarcoTrail</small>
                        <span class="feature-views">189 vues</span>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <article class="feature-card p-4">
                    <div class="feature-card-top d-flex justify-content-between align-items-start mb-3">
                        <span class="feature-badge badge-medium">Modérée</span>
                        <span class="feature-tag">Massif de l'Étoile</span>
                    </div>
                    <h3>Crête des Venturiers</h3>
                    <ul class="feature-meta list-unstyled mb-3">
                        <li>12 km · 680 m · 4h30</li>
                        <li>Sentier varié, vue dégagée, terrain forestier.</li>
                    </ul>
                    <div class="feature-footer d-flex justify-content-between align-items-center">
                        <small class="text-muted">LamineRando</small>
                        <span class="feature-views">247 vues</span>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="search-section py-5">
    <div class="container">
        <div class="section-label mb-3">PAGE — Liste des randonnées</div>
        <div class="search-panel card p-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control search-input" placeholder="Rechercher un massif, une commune...">
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>Toutes les difficultés</option>
                        <option>Facile</option>
                        <option>Modérée</option>
                        <option>Difficile</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>Tous les massifs</option>
                        <option>Calanques</option>
                        <option>Sainte-Victoire</option>
                        <option>Étoile</option>
                        <option>Alpilles</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-center">
                    <button class="btn btn-primary w-100">Rechercher</button>
                </div>
            </div>
        </div>

        <p class="text-muted mt-3">247 randonnées trouvées</p>

        <div class="row g-4">
            <div class="col-12">
                <div class="result-card card p-4">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-3 result-image bg-soft"></div>
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h3 class="result-title mb-1">Calanque de Sormiou — Boucle complète</h3>
                                    <small class="text-muted">Calanques · Marseille 9e</small>
                                </div>
                                <span class="badge badge-easy">Facile</span>
                            </div>
                            <p class="mb-2 text-muted">Vue imprenable sur la calanque et la mer, sentier ombragé, idéal le matin avant l'affluence estivale...</p>
                            <div class="result-meta d-flex gap-3 flex-wrap text-muted">
                                <span>8 km</span>
                                <span>320 m</span>
                                <span>2h30</span>
                                <span>LamineRando · 312 vues</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="result-card card p-4">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-3 result-image bg-soft-2"></div>
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h3 class="result-title mb-1">Crête de Sainte-Victoire</h3>
                                    <small class="text-muted">Sainte-Victoire · Aix-en-Provence</small>
                                </div>
                                <span class="badge badge-hard">Difficile</span>
                            </div>
                            <p class="mb-2 text-muted">Le mythique massif peint par Cézanne. Ascension technique avec panorama exceptionnel sur la Provence...</p>
                            <div class="result-meta d-flex gap-3 flex-wrap text-muted">
                                <span>18 km</span>
                                <span>1100 m</span>
                                <span>7h</span>
                                <span>MarcoTrail · 189 vues</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>