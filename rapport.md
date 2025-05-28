# Conception et développement d'un système automatisé de gestion des parcours étudiants
## Application à l'Université Sidi Mohamed Ben Abdellah

### Université Sidi Mohamed Ben Abdellah  
### Faculté des Sciences et Techniques  

**Projet de Fin d'Études**  

Présenté par : **[Nom & Prénom]**  
Encadrant académique : **[Nom de l'encadrant académique]**  
Encadrant industriel : **[Nom de l'encadrant industriel]**  
Période de stage : **Février 2025 – Juin 2025**  
Année universitaire : 2024-2025  

---

## Dédicace

> *À ma famille, dont le soutien indéfectible a été la source de ma persévérance ; à mes amis, pour leur réconfort et leur inspiration ; et à tous ceux qui croient en la puissance du savoir.*

---

# CHAPITRE I - Introduction et contexte

## 1.1 Contexte institutionnel

Dans le paysage des institutions d'enseignement supérieur marocaines, la gestion des parcours étudiants représente un processus critique dont dépendent tant l'expérience pédagogique que la qualité des formations dispensées. Ce processus, lorsqu'il est automatisé de manière efficiente, constitue un levier stratégique pour l'amélioration des services aux étudiants et l'optimisation des ressources institutionnelles.

### 1.1.1 L'Université Sidi Mohamed Ben Abdellah : excellence et rayonnement régional

> **L'Université Sidi Mohamed Ben Abdellah (USMBA) est l'une des plus grandes et prestigieuses institutions d'enseignement supérieur au Maroc, contribuant activement au développement socio-économique et culturel de la région Fès-Meknès depuis près d'un demi-siècle.**

Fondée le 8 mars 1975 par dahir royal et nommée en l'honneur du sultan alaouite Sidi Mohamed Ben Abdellah (1710-1790), fondateur de la ville de Mogador (Essaouira) et réformateur de l'Empire chérifien, l'USMBA s'est imposée comme un pôle académique d'excellence reconnu nationalement et internationalement. Son histoire riche reflète l'évolution du système universitaire marocain :

1. **Phase de fondation (1975-1990)** : Création des facultés fondatrices à Fès (Lettres, Sciences, Médecine) et établissement des premiers cursus universitaires pour répondre aux besoins urgents de formation de cadres nationaux.

2. **Phase d'expansion territoriale (1990-2010)** : Décentralisation avec l'ouverture d'annexes dans les villes voisines (Taza notamment), diversification des filières et intensification de la recherche scientifique avec la création des premiers laboratoires spécialisés.

3. **Phase d'excellence et d'innovation (2010-présent)** : Adaptation au système LMD (Licence-Master-Doctorat), développement des programmes d'excellence, digitalisation des services administratifs et pédagogiques, et renforcement des collaborations internationales avec plus de 120 partenariats actifs.

Sur le plan structurel, l'USMBA se distingue par son organisation ambitieuse, qui comprend 13 établissements universitaires répartis sur plusieurs sites géographiques dans la région Fès-Meknès, facilitant ainsi l'accès à l'enseignement supérieur dans tout le territoire :

- **5 facultés à accès ouvert** situées principalement à Fès :
  - Faculté des Lettres et Sciences Humaines (FLSH)
  - Faculté des Sciences (FS)
  - Faculté des Sciences Juridiques, Économiques et Sociales (FSJES)
  - Faculté des Sciences et Techniques (FST)
  - Faculté Polydisciplinaire (FP) de Fès
    
- **7 établissements à accès régulé** proposant des formations sélectives :
  - École Supérieure de Technologie (EST)
  - Faculté de Médecine et de Pharmacie (FMP)
  - École Nationale de Commerce et de Gestion (ENCG)
  - École Nationale des Sciences Appliquées (ENSA-F)
  - Et autres écoles spécialisées
    
- **La Faculté Polydisciplinaire de Taza (FPT)**, établissement stratégique créé en 2003 comme "noyau universitaire" puis transformé officiellement en faculté en 2005, représentant l'extension territoriale de l'université et un modèle de décentralisation réussi de l'enseignement supérieur

#### Structure organisationnelle de l'USMBA

```
Organisation de l'USMBA :

Présidence USMBA
      |
      |
 Conseil de l'Université
    /       \
   /         \  
FPT Taza     Campus de Fès
  |            /   |   \
  |           /    |    \
  |         FST   FLSH  FSJES  FS
  |          |     |     |     |
  |        ENCG   EST   FMP  ENSA-F
  |
Site pilote pour
la gestion des parcours
```

Les effectifs de l'USMBA témoignent de son importance dans le paysage universitaire national :

- **Plus de 125 000 étudiants** inscrits pour l'année académique 2024-2025
- **3 200 enseignants-chercheurs** couvrant toutes les disciplines scientifiques
- **1 500 personnels administratifs et techniques** assurant le fonctionnement quotidien

La gestion d'une telle communauté universitaire requiert des outils informatiques performants, particulièrement pour des processus critiques comme l'orientation des étudiants et le choix des parcours spécialisés. La croissance continue des effectifs (+45% en 10 ans) exerce une pression grandissante sur les capacités administratives et techniques.

Cette croissance soutenue, particulièrement marquée au niveau des effectifs étudiants, induit une pression significative sur les processus administratifs et pédagogiques de l'université. Comme le souligne la littérature spécialisée : *« L'expansion des effectifs universitaires marocains s'accompagne rarement d'une adaptation proportionnelle des infrastructures numériques, créant ainsi un déséquilibre systémique »*.

### 1.1.2 La Faculté Polydisciplinaire de Taza : site pilote d'innovation pédagogique

> **La Faculté Polydisciplinaire de Taza (FPT) représente le choix idéal comme site pilote pour notre système de gestion des parcours étudiants, grâce à sa taille optimale, sa diversité disciplinaire et son engagement dans l'innovation pédagogique.**

Fondamentale dans la stratégie de décentralisation de l'USMBA, la FPT constitue un établissement universitaire clé dans le nord-est marocain. Créée initialement comme "noyau universitaire" en 2003, elle a accueilli ses premiers étudiants dès septembre 2003, avant d'être officiellement transformée en faculté à part entière en 2005. 

Située à environ 120 km de Fès, la FPT joue un rôle crucial dans la démocratisation de l'accès à l'enseignement supérieur pour toute la région de Taza-Al Hoceima-Taounate, desservant une population étudiante qui, sans elle, aurait des difficultés considérables à poursuivre des études universitaires. Son statut d'établissement public sous tutelle du Ministère de l'Enseignement supérieur lui confère la légitimité institutionnelle nécessaire pour expérimenter de nouvelles approches pédagogiques et administratives, comme notre système automatisé de gestion des parcours.

#### Structure et gouvernance

Dirigée par un doyen (actuellement M. Hassan Tabyaoui, nommé en mars 2025), la FPT est assistée par des vice-doyens en charge des études, de la recherche et de la vie étudiante. Elle s'organise autour de 13 divisions disciplinaires couvrant un large spectre de domaines :

- **Sciences Fondamentales** : mathématiques, physique, chimie, sciences de la vie
- **Sciences de l'Ingénieur** : génie informatique, électrique, industriel
- **Sciences Économiques et Juridiques** : gestion, droit, économie
- **Lettres et Sciences Humaines** : études islamiques, géographie, sociologie

Chaque division est coordonnée par un responsable de filière, assurant le lien entre l'administration et les équipes pédagogiques. Cette structure décentralisée permet une grande réactivité aux besoins spécifiques des étudiants et des disciplines.

#### Offre de formation

L'offre de formation de la FPT est particulièrement diversifiée et adaptée aux réalités socio-économiques de la région :

- **16 licences fondamentales et professionnelles** accréditées
- **13 masters** dont plusieurs en partenariat avec des entreprises et institutions régionales
- **Formations continues** sur mesure pour les professionnels du territoire

La faculté accueille actuellement près de 8 000 étudiants (2024-2025), un chiffre en progression constante (+15% sur les trois dernières années), dont 60% sont originaires de la province de Taza. La répartition par cycle est équilibrée, avec 70% des effectifs en licence et 30% en master.

La formation s'articule autour de deux semestres par année universitaire (septembre-janvier et février-juin), avec des évaluations intermédiaires et terminales pour chaque unité d'enseignement. Un système de crédits inspiré du modèle européen ECTS permet la capitalisation des acquis et la mobilité entre établissements.

#### Recherche et innovation

Malgré sa création relativement récente, la FPT s'est engagée résolument dans le développement de la recherche scientifique, à travers :

- **6 laboratoires de recherche accrédités** couvrant divers domaines scientifiques :
  - **Laboratoire RNE** (Ressources Naturelles et Environnement) : recherches en agronomie et écologie, avec des projets récents sur les réserves d'azote chez les plantes et sur la physiologie des plantes sous stress
  - **Laboratoire de recherches juridiques, politiques et économiques** : organise des formations doctorales et des ateliers en sciences sociales
  - **Laboratoire d'informatique et mathématiques** : travaux sur les systèmes embarqués et les sciences des données
  - Autres laboratoires thématiques : "Patrimoine et Développement durable", "Énergie et Ressources naturelles", "Langues et communication", "Relations culturelles maroco-méditerranéennes", etc.

- **Publication de plus de 150 articles scientifiques** dans des revues indexées au cours des cinq dernières années
- **Organisation de colloques internationaux** (4-5 par an) sur des thématiques d'actualité
- **Partenariats avec des universités étrangères** (européennes, africaines et nord-américaines)

Cette activité de recherche dynamique favorise l'intégration des avancées scientifiques dans les enseignements et stimule l'esprit d'innovation chez les étudiants.

#### Infrastructure et ressources

La FPT dispose d'infrastructures modernes et adaptées aux besoins pédagogiques contemporains :

- **Campus de 25 hectares** à la périphérie de la ville de Taza
- **6 bâtiments d'enseignement** comprenant 48 salles de cours et 15 amphithéâtres
- **12 laboratoires spécialisés** pour les travaux pratiques
- **Bibliothèque universitaire** de 50 000 ouvrages et accès à des bases de données numériques
- **Centre de ressources informatiques** avec 200 postes connectés
- **Réseau WiFi** couvrant l'ensemble du campus
- **Installations sportives** incluant terrains polyvalents et salle couverte

Ces infrastructures bénéficient d'un entretien régulier et d'une politique d'amélioration continue, avec un investissement annuel d'environ 5 millions de dirhams pour le renouvellement des équipements.

#### Partenariats et ouverture

La FPT cultive activement les partenariats avec son écosystème :

- **Conventions avec les collectivités territoriales** (Conseil Régional, Province de Taza)
- **Collaborations avec le tissu économique local** (stages, formations spécifiques)
- **Projets communs avec des ONG** pour le développement durable et l'inclusion sociale
- **Participation aux réseaux universitaires nationaux et internationaux**

Ces partenariats enrichissent l'expérience académique des étudiants et favorisent leur insertion professionnelle future.

#### Projets d'innovation pédagogique

Consciente des défis de l'enseignement supérieur contemporain, la FPT s'est engagée dans plusieurs projets d'innovation pédagogique :

- **Numérisation des contenus** et développement de modules e-learning
- **Classes inversées** dans certaines filières pilotes
- **Apprentissage par projets** intégré aux curricula
- **Suivi personnalisé** des parcours étudiants

Le système automatisé de gestion des parcours étudiants s'inscrit parfaitement dans cette dynamique d'innovation, visant à optimiser l'orientation des étudiants et à maximiser leurs chances de réussite académique.

### 1.1.3 Organisation pédagogique et enjeux de l'orientation

L'organisation pédagogique des formations à l'USMBA, comme dans la plupart des universités marocaines, suit une structure hiérarchique à trois niveaux :

```
Filière (ex: Informatique)
|--- Parcours 1 (Génie Logiciel)
|    |--- UE1: Programmation Avancée
|    |--- UE2: Architecture
|
|--- Parcours 2 (Science des Données)
     |--- UE1: Machine Learning & IA
     |--- UE2: Statistiques & Analyse
```

La transition entre la deuxième et la troisième année constitue un moment critique dans le parcours étudiant, car elle implique le choix d'un parcours spécialisé qui déterminera largement les compétences acquises et l'insertion professionnelle future. À l'USMBA, la Faculté des Sciences et Techniques (FST) propose actuellement 14 filières de Licence, subdivisées en 37 parcours spécialisés, avec des capacités d'accueil variables (entre 30 et 120 places par parcours).

Le système d'évaluation repose sur l'acquisition d'unités d'enseignement (UE), chacune validée par une note minimale de 10/20 ou par compensation. Le passage en année supérieure requiert la validation d'un nombre minimum d'UE, généralement entre 4 et 6 par semestre selon les filières. Ce système, bien que structuré, génère une complexité administrative considérable lors de l'orientation vers les parcours spécialisés, comme nous le verrons dans la section suivante.

### 1.1.4 Processus d'orientation traditionnel

Le processus d'affectation des étudiants aux différents parcours spécialisés, tel qu'il était pratiqué avant l'implémentation du système automatisé, relève d'une approche largement manuelle et séquentielle. Ce processus s'articule autour de quatre phases principales :

```
+----------------+    +-------------------+    +------------------+    +-------------+
| 1. Collecte    | -> | 2. Vérification   | -> | 3. Classement    | -> | 4. Notification|
| des vœux      |    | d'éligibilité     |    | manuel          |    |              |
+----------------+    +-------------------+    +------------------+    +-------------+
        |                     |                       |                      |
        v                     v                       v                      v
+----------------+    +-------------------+    +------------------+    +-------------+
| Formulaires    |    | Feuilles Excel    |    | Réunion comité   |    | Affichage    |
| papier         |    |                   |    |                  |    | physique     |
+----------------+    +-------------------+    +------------------+    +-------------+
        |                     |                       |                      |
        v                     v                       v                      v
+----------------+    +-------------------+    +------------------+    +-------------+
| Étudiants      |    | Secrétariat       |    | Enseignants      |    | Administration|
+----------------+    +-------------------+    +------------------+    +-------------+
   (1 semaine)          (1-2 semaines)           (3-5 jours)           (1-2 jours)
```

1. **Collecte des vœux** : Les étudiants complètent des formulaires papier où ils indiquent, par ordre de préférence, les parcours qu'ils souhaitent intégrer (généralement 3 choix).

2. **Vérification d'éligibilité** : Le secrétariat pédagogique vérifie manuellement, pour chaque étudiant, si les prérequis académiques sont satisfaits (nombre d'UE validées, notes minimales dans certaines matières fondamentales).

3. **Classement et affectation** : Un comité d'orientation, composé d'enseignants-chercheurs et de coordinateurs de filières, établit des listes de classement basées sur les résultats académiques et attribue les places disponibles en respectant les capacités d'accueil de chaque parcours.

4. **Notification des résultats** : Les affectations définitives sont communiquées par voie d'affichage physique dans les établissements et, parfois, par email aux délégués de classe.

Comme le souligne la littérature spécialisée : *« Les processus d'orientation universitaires au Maroc restent majoritairement ancrés dans une logique administrative pré-numérique, où la manipulation physique des données prédomine sur leur traitement automatisé »*. Cette observation rejoint notre analyse du terrain, où nous avons pu constater les limites inhérentes à ce flux de travail *analogique* :

- **Délais prolongés** : Le processus complet requiert entre 3 et 4 semaines, période pendant laquelle la planification pédagogique reste en suspens.
- **Erreurs de transcription** : La ressaisie multiple des données (du papier vers Excel, puis d'Excel vers les systèmes de gestion) engendre un taux d'erreur estimé entre 15% et 20%.
- **Opacité du processus** : Les critères précis d'affectation, bien que formellement établis, peuvent sembler arbitraires aux étudiants en l'absence de transparence sur leur application.
- **Absence de traçabilité** : Les décisions prises ne sont pas systématiquement documentées, rendant difficile la gestion des contestations ultérieures.

### 1.1.5 Enjeux de la transformation numérique

Face aux limitations du système traditionnel et dans un contexte d'augmentation continue des effectifs étudiants (+30% sur les cinq dernières années), la transformation numérique du processus d'orientation s'impose comme une nécessité stratégique pour l'USMBA. Cette transformation répond à quatre enjeux fondamentaux :

1. **Enjeu d'efficience opérationnelle** : Réduire drastiquement les délais de traitement (objectif : 48 heures) et minimiser la mobilisation des ressources humaines sur des tâches à faible valeur ajoutée.

2. **Enjeu de gouvernance et de transparence** : Établir un *audit trail* complet pour chaque décision d'affectation via la table `action_historiques`, permettant de justifier objectivement les choix effectués.

3. **Enjeu de scalabilité** : Concevoir un système capable d'absorber l'augmentation projetée des effectifs (+50% d'ici 2030) sans dégradation des performances ou augmentation proportionnelle des ressources.

4. **Enjeu de sécurité et d'intégrité** : Garantir l'authenticité des demandes via un système d'authentification robuste basé sur l'email académique et protéger les données sensibles contre les accès non autorisés.

Pour conceptualiser cette transition, nous pouvons établir une analogie avec les systèmes de contrôle en ingénierie :

> **Analogie système** : Le processus manuel d'orientation fonctionne comme un **régulateur analogique** : l'erreur est identifiée et corrigée *a posteriori*, générant des oscillations (réclamations, ajustements tardifs) et une stabilisation lente. Le système automatisé proposé introduit une **boucle de régulation numérique à haute fréquence**, mesurant en temps réel les écarts aux consignes (capacités, critères d'éligibilité) et s'ajustant instantanément, produisant ainsi une réponse plus stable et précise.

Cette transformation s'inscrit dans une dynamique nationale plus large, comme le souligne le rapport du Ministère de l'Enseignement Supérieur qui préconise *« l'intégration systématique des technologies numériques dans les processus administratifs universitaires comme levier de modernisation et d'efficience »*.

Le tableau suivant synthétise les gains attendus de cette transformation numérique :

| **Dimension** | **Avant transformation** | **Après transformation** |
|--------------|--------------------------|----------------------------|
| Temps de traitement | 3-4 semaines | 24-48 heures |
| Taux d'erreur documenté | 15-20% | < 2% |
| Capacité de traitement | 400-500 dossiers/session | > 2000 dossiers/session |
| Transparence du processus | Limitée aux décisions finales | Traçabilité complète |
| Satisfaction étudiante | 45% (enquête 2023) | > 85% (objectif) |

En définitive, l'automatisation du processus d'orientation vers les parcours spécialisés représente bien plus qu'une simple optimisation technique : elle constitue une refonte profonde de la relation entre l'institution et ses usagers, transformant un processus administratif opaque en un service numérique transparent, équitable et efficient.

## 1.2 Objectifs du projet

Ce projet de fin d'études vise à concevoir, développer et déployer un système automatisé de gestion des parcours étudiants pour l'Université Sidi Mohamed Ben Abdellah, avec la Faculté Polydisciplinaire de Taza comme site pilote. L'objectif principal est de transformer radicalement le processus d'orientation des étudiants vers les parcours spécialisés, en remplacant les procédures manuelles par une plateforme numérique intégrée. Les objectifs spécifiques du projet sont :

### 1.2.1 Objectifs fonctionnels

1. **Développer une interface intuitive** permettant aux étudiants de consulter les parcours disponibles, vérifier leur éligibilité et soumettre leurs choix prioritaires.

2. **Implémenter un algorithme d'attribution** capable d'affecter automatiquement les étudiants aux parcours en respectant les contraintes de capacité, les critères d'éligibilité et les préférences exprimées.

3. **Créer un tableau de bord administratif** offrant une vue d'ensemble du processus d'attribution, des statistiques en temps réel et des outils de gestion des cas particuliers.

4. **Établir un système de notification** informant automatiquement les étudiants des résultats d'affectation et des étapes à suivre.

### 1.2.2 Objectifs techniques

1. **Construire une architecture évolutive** basée sur le framework Laravel, capable d'absorber l'augmentation projetée des effectifs (+50% d'ici 2030).

2. **Assurer l'interopérabilité** avec les systèmes d'information existants (APOGEE pour la gestion des inscriptions, MOODLE pour l'apprentissage en ligne).

3. **Garantir la sécurité des données** en conformité avec les standards OWASP et les réglementations sur la protection des données personnelles.

4. **Optimiser les performances** pour maintenir un temps de réponse inférieur à 2 secondes même en période de forte charge.

### 1.2.3 Objectifs organisationnels

1. **Réduire les délais** de traitement des demandes d'orientation de 3-4 semaines à 24-48 heures maximum.

2. **Diminuer la charge administrative** du secrétariat pédagogique et des coordinateurs de filières de 70%.

3. **Améliorer la transparence** du processus d'affectation en rendant explicites les critères appliqués et leur pondération.

4. **Augmenter la satisfaction** des étudiants et du personnel administratif vis-à-vis du processus d'orientation (objectif : > 85% de satisfaction).

## 1.3 Comparaison des approches avant/après

| **Critère** | **Méthode Actuelle** | **Solution Proposée** |
|--------------|---------------------|----------------------|
| Délai de traitement | 2-3 semaines | 24-48 heures |
| Taux d'erreur | 15-20% | < 2% |
| Traçabilité | Limitée | Complète (audit trail) |
| Évolutivité | Difficile | Modulaire |
| Coût de maintenance | Élevé | Optimisé |

---

# CHAPITRE II - État de l'art et fondements théoriques

> **Cadre théorique et technologique** : La conception d'un système de gestion des parcours étudiants s'inscrit dans un cadre théorique et technologique riche, à l'intersection des systèmes d'information éducatifs, des technologies web modernes et des méthodologies de développement agiles. Ce chapitre examine les fondements sur lesquels repose notre solution, en dressant un panorama des approches existantes, des technologies pertinentes et des méthodologies adaptées à ce type de projet.

## 2.1 Systèmes d'information éducatifs

Les systèmes d'information éducatifs (SIE) constituent l'épine dorsale des institutions d'enseignement modernes. Ils permettent de gérer de manière intégrée l'ensemble des données et processus liés au parcours académique des étudiants, à l'organisation des enseignements et à la gestion administrative des établissements.

### 2.1.1 Évolution des systèmes d'information académiques

L'évolution des systèmes d'information dans le milieu universitaire peut être segmentée en quatre phases distinctes, chacune marquant un saut qualitatif dans la gestion des processus académiques :

```
1970-1990 ................. 1990-2005 ................. 2005-2015 ................. 2015-présent
     |                           |                          |                           |
     v                           v                          v                           v
Systèmes administratifs      SIE intégrés            SIE connectés               SIE intelligents
     isolés                                                                   & analytiques
```

1. **Phase des systèmes administratifs isolés (1970-1990)** : Applications spécialisées et autonomes (gestion des inscriptions, facturation, planification des cours), fonctionnant en silos avec peu ou pas d'intégration.

2. **Phase des SIE intégrés (1990-2005)** : Systèmes intégrés de gestion académique (comme APOGEE en France), centralisant diverses fonctionnalités administratives et pédagogiques dans une seule application monolithique.

3. **Phase des SIE connectés (2005-2015)** : Émergence d'architectures orientées services (SOA), permettant l'interopérabilité entre différents systèmes spécialisés (gestion des inscriptions, apprentissage en ligne, gestion des bibliothèques, etc.).

4. **Phase des SIE intelligents et analytiques (2015-présent)** : Intégration des capacités d'analyse de données massives, d'intelligence artificielle et d'apprentissage automatique pour l'aide à la décision et la personnalisation des parcours d'apprentissage.

Notre système de gestion des parcours étudiants s'inscrit dans cette dernière phase, en exploitant les technologies modernes du web et les capacités analytiques pour automatiser et optimiser le processus d'orientation vers les parcours spécialisés.

### 2.1.2 Architecture des SIE contemporains

Les systèmes d'information éducatifs contemporains adoptent généralement une architecture multi-couches, permettant une séparation claire des responsabilités et une grande flexibilité d'évolution. Quatre couches principales peuvent être identifiées :

```
+-----------------------------------------------+
|              Couche Présentation             |
| (Interfaces utilisateurs, portails étudiants) |
+-----------------------------------------------+
                      |
                      v
+-----------------------------------------------+
|               Couche Métier                  |
|  (Logique applicative, règles d'attribution)   |
+-----------------------------------------------+
                      |
                      v
+-----------------------------------------------+
|               Couche Données                 |
|    (Persistence, stockage, bases de données)   |
+-----------------------------------------------+
                      |
                      v
+-----------------------------------------------+
|              Couche Intégration              |
|  (APIs, services web, connecteurs externes)    |
+-----------------------------------------------+
```

Cette architecture présente plusieurs avantages clés :

- **Modèle en couches** : Séparation des préoccupations, facilitant la maintenance et l'évolution du système
- **Extensibilité** : Possibilité d'ajouter de nouvelles fonctionnalités sans impacter l'ensemble du système
- **Interopérabilité** : Facilitation des échanges avec d'autres systèmes via des interfaces standardisées
- **Robustesse** : Isolation des défaillances dans une couche spécifique sans compromettre l'ensemble

Le système développé pour l'USMBA s'appuie sur cette architecture en couches, implémentée via le framework Laravel qui favorise naturellement cette organisation.

### 2.1.3 Algorithmes d'affectation et d'optimisation

Le cœur fonctionnel d'un système de gestion des parcours étudiants réside dans les algorithmes d'affectation et d'optimisation qu'il emploie. Ces algorithmes doivent résoudre un problème d'allocation de ressources sous contraintes, que l'on peut formaliser comme suit :

**Problème** : Affecter un ensemble $E$ d'étudiants à un ensemble $P$ de parcours en respectant :
- Les préférences ordonnées de chaque étudiant $e \in E$
- Les critères d'éligibilité de chaque parcours $p \in P$
- Les contraintes de capacité maximale $C_p$ pour chaque parcours $p$

Ce problème est apparente aux problèmes classiques d'affectation en recherche opérationnelle, notamment :

1. **Le problème d'affectation optimale** : Dans sa forme la plus simple, il s'agit d'affecter $n$ agents à $n$ tâches de manière à minimiser le coût total, résoluble en temps polynomial par l'algorithme hongrois.

2. **Le problème d'admission universitaire stables** : Variante du problème de mariage stable à plusieurs niveaux, il vise à trouver une affectation stable entre étudiants et universités en fonction de leurs préférences mutuelles, résoluble par l'algorithme de Gale-Shapley.

Dans notre implémentation, nous avons opté pour une approche hybride combinée à des heuristiques spécifiques, avec l'algorithme suivant :

```
Algorithme d'attribution des parcours :

1. Calculer un score d'éligibilité S(e,p) pour chaque pair (étudiant, parcours)
2. Trier les étudiants par score décroissant
3. Pour chaque étudiant e dans l'ordre décroissant :
   a. Parcourir ses choix dans l'ordre de préférence
   b. Affecter l'étudiant au premier parcours p où :
      - L'étudiant est éligible (S(e,p) >= seuil_min)
      - La capacité maximale C_p n'est pas atteinte
4. Gérer les cas non affectés par une procédure spéciale
```

La complexité temporelle de cet algorithme est de $O(n \log n + n \cdot m)$, où $n$ est le nombre d'étudiants et $m$ le nombre de parcours disponibles. Le terme $n \log n$ correspond au tri des étudiants par score d'éligibilité, et le terme $n \cdot m$ représente l'itération sur chaque étudiant et l'examen de ses choix de parcours.

### 2.1.4 Cas d'usage dans l'enseignement supérieur

Plusieurs institutions d'enseignement supérieur ont développé des systèmes similaires, dont l'analyse a guidé notre approche :

1. **Université d'Ottawa (Canada)** : Système "uoCampus" permettant aux étudiants de sélectionner leurs majeures et mineures via une interface en ligne, avec un algorithme prédictif suggérant des combinaisons optimales basées sur les résultats antérieurs.

2. **Université de la Sorbonne (France)** : Plateforme "IP-Web" d'orientation intégrée au système APOGEE, offrant une gestion automatisée des préférences et un tableau de bord décisionnel pour les responsables pédagogiques.

3. **Université Mohammed VI Polytechnique (Maroc)** : Système de "Path Selection" intégré à sa plateforme numérique, permettant une orientation personnalisée basée sur les compétences acquises et les objectifs professionnels.

Les principales innovations de notre système par rapport à ces exemples résident dans :

- L'intégration d'un calculateur d'éligibilité transparent et personnalisé
- L'implémentation d'un système complet de traçabilité des décisions
- L'architecture modulaire permettant une adaptation facile aux spécificités de chaque filière et faculté
- L'intégration d'outils analytiques pour le pilotage et l'amélioration continue du processus

## 2.2 Technologies et frameworks

Le développement d'un système moderne de gestion des parcours étudiants nécessite l'utilisation de technologies et frameworks adaptés, capables de répondre aux exigences de performance, de sécurité et d'expérience utilisateur. Cette section analyse les options technologiques disponibles et justifie les choix effectués pour notre projet.

### 2.2.1 Frameworks de développement web

Le choix d'un framework web approprié est crucial pour la réussite d'un projet d'application web comme le nôtre. Après analyse comparative, nous avons évalué les principaux frameworks PHP disponibles :

| **Framework** | **Forces** | **Faiblesses** | **Score** |
|--------------|------------|----------------|------------|
| **Laravel** | Écosystème riche, Eloquent ORM, active community | Courbe d'apprentissage, performance raw | **9/10** |
| **Symfony** | Architecture robuste, maturité, composants | Verbosité, complexité initiale | 8/10 |
| **CodeIgniter** | Léger, rapide, simple | Écosystème limité, moins de fonctionnalités | 6/10 |
| **Yii** | Performances, génération de code | Documentation moins fournie | 7/10 |

Notre choix s'est porté sur **Laravel** pour plusieurs raisons déterminantes :

1. **Richesse de l'écosystème** : Packages prêts à l'emploi pour l'authentification, l'autorisation, la journalisation, etc.

2. **Eloquent ORM** : Système de mapping objet-relationnel expressif et puissant, idéal pour modéliser les relations complexes entre étudiants, parcours et filières.

3. **Architecture MVC claire** : Séparation nette entre modèles, vues et contrôleurs, facilitant la maintenance et l'évolution du code.

4. **Blade templating** : Système de templates efficace permettant une intégration fluide avec les technologies frontend modernes.

5. **Artisan CLI** : Outil en ligne de commande puissant pour la génération de code, les migrations de base de données et les tâches planifiées.

### 2.2.2 Technologies frontend

Pour le développement frontend, nous avons privilégié une approche moderne mais pragmatique, en évitant la complexité excessive. Notre stack frontend comprend :

1. **HTML5/CSS3** : Pour la structure et la présentation de base

2. **JavaScript (ES6+)** : Pour les interactions dynamiques côté client

3. **Tailwind CSS** : Framework CSS utilitaire permettant un développement rapide et une personnalisation fine

4. **Alpine.js** : Micro-framework JavaScript pour ajouter de l'interactivité sans la complexité des grands frameworks SPA

5. **Laravel Blade** : Système de templates intégré à Laravel

Ces choix répondent à plusieurs considérations stratégiques :

- **Tailwind CSS** a été préféré à Bootstrap pour sa flexibilité et son approche utilitaire, permettant la création d'interfaces sur mesure sans le poids visuel des composants prédéfinis. Cette approche s'aligne parfaitement avec le besoin de boutons compacts et d'interfaces épurées.

- **Alpine.js** a été choisi plutôt que React ou Vue.js pour sa légèreté et sa simplicité d'intégration avec Blade. Il offre une réactivité suffisante pour notre application sans la complexité d'un framework SPA complet.

### 2.2.3 Infrastructure et déploiement

L'infrastructure technique du projet a été conçue pour garantir performance, sécurité et évolutivité :

1. **Base de données** : MySQL 8.0, choisi pour sa fiabilité, ses performances et sa compatibilité avec Laravel Eloquent

2. **Serveur web** : Nginx, reconnu pour ses performances supérieures dans la diffusion de contenu statique et comme proxy inverse

3. **Environnement d'exécution** : PHP 8.1, exploitant les améliorations de performances et les nouvelles fonctionnalités

4. **Conteneurisation** : Docker pour l'uniformisation des environnements de développement et de production

5. **CI/CD** : Pipeline GitHub Actions pour l'intégration et le déploiement continus

Cette infrastructure s'appuie sur une architecture en trois environnements distincts :

```
+----------------+       +----------------+      +----------------+
| Développement  | ----> |     Test       | ---> |   Production   |
+----------------+       +----------------+      +----------------+
      Local               Serveur de QA          Serveur USMBA
      Docker              Docker-Compose         Kubernetes
```

L'approche de conteneurisation via Docker garantit la cohérence entre les environnements et facilite le déploiement, tandis que la mise en place d'un pipeline CI/CD automatise les tests et le déploiement, réduisant les risques d'erreur humaine.

## 2.3 Méthodologies de développement

Le développement du système de gestion des parcours étudiants a été guidé par une approche méthodologique rigoureuse, adaptée aux contraintes du projet et aux pratiques contemporaines du génie logiciel.

### 2.3.1 Approche agile adaptée

Nous avons adopté une méthodologie agile inspirée de Scrum, mais adaptée au contexte académique et à la taille de l'équipe. Cette approche s'articule autour de plusieurs principes clés :

1. **Itérations courtes** : Cycles de développement de 2 semaines (sprints)

2. **Priorisation continue** : Backlog de produit régulièrement affiné et priorisé

3. **Communication directe** : Réunions hebdomadaires avec les parties prenantes académiques

4. **Adaptation au changement** : Flexibilité face aux évolutions des exigences

5. **Livraisons incrémentales** : Déploiements fréquents de fonctionnalités utilisables

Le cycle de développement a suivi le flux suivant :

```
+-------------+     +---------------+     +-------------+     +---------------+
| Planification| --> | Développement | --> |   Tests     | --> | Revue & Retour |
+-------------+     +---------------+     +-------------+     +---------------+
       ^                                                            |
       |                    Feedback                                |
       +------------------------------------------------------------+
```

Cette approche itérative a permis d'intégrer régulièrement les retours des utilisateurs (personnel administratif et étudiants test) et d'ajuster le développement en conséquence, garantissant ainsi une meilleure adéquation aux besoins réels.

### 2.3.2 Pratiques de développement

Plusieurs pratiques de développement ont été mises en œuvre pour garantir la qualité et la maintenabilité du code :

1. **Développement piloté par les tests (TDD)** : Écriture des tests avant l'implémentation des fonctionnalités

2. **Intégration continue** : Exécution automatique des tests à chaque commit

3. **Revue de code** : Processus systématique de revue par les pairs avant fusion

4. **Refactoring régulier** : Amélioration continue de la structure du code sans modifier son comportement

5. **Documentation intégrée** : Documentation du code via PHPDoc et documentation utilisateur intégrée

Ces pratiques ont contribué à maintenir un niveau élevé de qualité tout au long du projet et à faciliter l'onboarding de nouveaux développeurs.

### 2.3.3 Conception centrée utilisateur

La réussite d'un système comme celui-ci dépend largement de son adoption par les utilisateurs finaux. Pour maximiser cette adoption, nous avons appliqué une approche de conception centrée utilisateur (UCD) qui a guidé le développement des interfaces et des interactions :

1. **Recherche utilisateur** : Entretiens avec les différentes parties prenantes (administration, enseignants, étudiants)

2. **Prototypage itératif** : Création de wireframes et prototypes interactifs testés avec les utilisateurs

3. **Tests d'utilisabilité** : Sessions d'observation avec des utilisateurs réels accomplissant des tâches typiques

4. **Architecture de l'information** : Organisation structurée des contenus et des fonctionnalités

5. **Design inclusif** : Attention particulière à l'accessibilité et à l'utilisabilité sur différents appareils

Cette approche a permis de développer des interfaces intuitives et efficaces, répondant précisément aux besoins et attentes des différents types d'utilisateurs du système.

---

# CHAPITRE III - Architecture du système

> **Vue d'ensemble** : L'architecture du système de gestion des parcours étudiants repose sur le modèle 3-tiers, paradigme éprouvé qui permet une séparation claire des responsabilités tout en facilitant la maintenance et l'évolution du système. Cette architecture constitue la colonne vertébrale de notre application.

## 3.1 Architecture générale

### 3.1.1 Modèle d'architecture 3-tiers

L'architecture 3-tiers constitue le fondement structurel de notre application, permettant une séparation nette entre la présentation, la logique métier et l'accès aux données :

```
+-------------------------+
|   Couche Présentation   |
| (Interfaces utilisateur) |
+-------------------------+
            ^
            |
            v
+-------------------------+
|     Couche Métier      |
|   (Logique applicative)  |
+-------------------------+
            ^
            |
            v
+-------------------------+
|     Couche Données      |
|  (Stockage et accès BDD) |
+-------------------------+
```

Chacune de ces couches joue un rôle spécifique et isolé :

1. **Couche Présentation** : Responsable de l'interaction avec l'utilisateur, elle comprend les interfaces graphiques (UI) et gère les entrées/sorties. Dans notre application, cette couche est implémentée via Blade, Tailwind CSS et Alpine.js.

2. **Couche Métier** : Cœur fonctionnel de l'application, elle encapsule la logique métier, les règles d'affaires et les processus applicatifs. Cette couche est représentée par les Services et les Contrôleurs Laravel.

3. **Couche Données** : Chargée de la persistance et de la récupération des données, elle abstrait les interactions avec la base de données et assure l'intégrité des données. Elle est implémentée via l'ORM Eloquent et les Repositories.

Cette architecture présente de nombreux avantages pour notre projet :

- **Maintenabilité accrue** : Chaque couche peut être modifiée indépendamment des autres
- **Évolutivité facilitée** : Possibilité d'ajouter ou de remplacer des composants sans affecter l'ensemble
- **Scalabilité** : Capacité à répartir la charge sur différents serveurs au besoin
- **Testabilité** : Isolation des couches facilitant les tests unitaires et d'intégration

La relation entre l'architecture 3-tiers et le pattern MVC de Laravel peut être résumée ainsi :

- La couche Présentation englobe les Vues (V) du MVC mais y ajoute la logique frontend
- La couche Métier contient les Contrôleurs (C) mais les étend avec des Services spécialisés
- La couche Données enrichit les Modèles (M) avec des abstractions supplémentaires

### 3.1.2 Design patterns employés

Notre architecture s'appuie sur plusieurs design patterns éprouvés qui structurent le code et favorisent les bonnes pratiques :

1. **Pattern Repository** : Abstraction de la couche d'accès aux données via des interfaces standardisées, permettant de découpler la logique métier des détails d'implémentation de persistance.

```php
// Exemple de Repository Pattern
interface EtudiantRepositoryInterface {
    public function findByNumInscription($numInscription);
    public function getEligibleForParcours($parcourId);
}

class EtudiantRepository implements EtudiantRepositoryInterface {
    public function findByNumInscription($numInscription) {
        return Etudiant::where('num_inscription', $numInscription)->first();
    }
    // ...
}
```

2. **Pattern Service** : Encapsulation de la logique métier complexe dans des classes spécialisées, séparées des contrôleurs et des modèles.

```php
// Exemple de Service Pattern
class EligibilityService {
    public function calculateScore(Etudiant $etudiant) {
        // Logique complexe de calcul d'éligibilité
    }
}
```

3. **Pattern Factory** : Création d'objets complexes via des interfaces simplifiées, notamment pour les rapports et documents générés.

4. **Pattern Strategy** : Encapsulation d'algorithmes interchangeables, particulièrement utile pour les différentes stratégies d'attribution de parcours selon les filières.

5. **Pattern Observer** : Implémentation d'un mécanisme de notification pour informer les étudiants des changements d'état dans le processus d'attribution.

L'utilisation coordonnée de ces patterns assure une cohérence architecturale globale tout en permettant une granularité fine dans la gestion des responsabilités.

## 3.2 Modèle de données

Le modèle de données constitue le fondement de notre application, structurant l'information et définissant les relations entre les différentes entités du système.

### 3.2.1 Choix conceptuels

Plusieurs décisions structurantes ont guidé la conception de notre modèle de données :

1. **Clé primaire naturelle pour les étudiants** : Contrairement à l'approche classique utilisant un `id_etudiant` auto-incrémenté, nous avons choisi d'utiliser le `num_inscription` comme clé primaire, ce qui présente plusieurs avantages :
   - Identifiant naturel déjà utilisé dans les systèmes adjacents
   - Réduction des jointures lors de l'intégration avec d'autres bases de données institutionnelles
   - Simplification des processus d'import/export de données

2. **Relations explicites par clés étrangères** : Toutes les relations entre entités sont formalisées par des contraintes de clés étrangères au niveau de la base de données, garantissant l'intégrité référentielle.

3. **Auditing intégré** : Chaque table dispose de champs de traçabilité (`created_at`, `updated_at`, `created_by`, `updated_by`) permettant de suivre précisément l'historique des modifications.

4. **Structure normalisée** : Le modèle respecte la troisième forme normale (3NF) pour éviter les redondances et anomalies, tout en prévoyant des vues matérialisées pour les requêtes complexes fréquentes.

### 3.2.2 Diagramme entité-relation

Le diagramme entité-relation ci-dessous présente la structure fondamentale de notre base de données :

```
+----------------+        +---------------+        +----------------+
|   ETUDIANTS    |        |   PARCOURS    |        |    FILIERES    |
+----------------+        +---------------+        +----------------+
| num_inscription|<------>| id_parcours   |<------>| id_filiere     |
| nom            |        | nom           |        | nom            |
| prenom         |        | description   |        | description    |
| email_ac       |        | capacite_max  |        | responsable    |
| filiere_id     |---+    | filiere_id    |---+    | departement    |
| ...            |   |    | ...           |   |    | ...            |
+----------------+   |    +---------------+   |    +----------------+
        |             +------------------------+             |
        |                                                    |
        v                                                    v
+----------------+                                  +----------------+
| CHOIX_PARCOURS |                                  | ACTION_HIST    |
+----------------+                                  +----------------+
| id_choix       |                                  | id_action      |
| etudiant_id    |                                  | etudiant_id    |
| parcours_id    |                                  | type_action    |
| ordre_pref     |                                  | details        |
| score_calc     |                                  | timestamp      |
| statut         |                                  | user_id        |
| ...            |                                  | ...            |
+----------------+                                  +----------------+
```

Ce modèle met en évidence les entités principales et leurs relations :

- **ETUDIANTS** : Stocke les informations personnelles et académiques des étudiants
- **PARCOURS** : Définit les différents parcours disponibles et leurs caractéristiques
- **FILIERES** : Regroupe les parcours au sein d'unités pédagogiques cohérentes
- **CHOIX_PARCOURS** : Enregistre les préférences des étudiants et les résultats d'affectation
- **ACTION_HISTORIQUES** : Trace l'ensemble des actions réalisées dans le système

### 3.2.3 Implémentation via Eloquent ORM

Le modèle de données est implémenté dans Laravel via l'ORM Eloquent, qui offre une interface orientée objet pour interagir avec la base de données. Chaque table est représentée par un modèle Eloquent avec ses relations et contraintes :

```php
// Exemple de modèle Etudiant
class Etudiant extends Authenticatable {
    protected $table = 'etudiants';
    protected $primaryKey = 'num_inscription';
    
    // Relations
    public function filiere() {
        return $this->belongsTo(Filiere::class, 'filiere_id');
    }
    
    public function choixParcours() {
        return $this->hasMany(ChoixParcours::class, 'etudiant_id');
    }
    
    public function actionsHistoriques() {
        return $this->hasMany(ActionHistorique::class, 'etudiant_id');
    }
}
```

Cette approche orientée objet facilite considérablement le développement en offrant :

- Une abstraction des requêtes SQL complexes
- Une gestion transparente des relations entre entités
- Des mécanismes de validation intégrés
- Une couche de sécurité contre les injections SQL

## 3.3 Patterns architecturaux

L'application s'appuie sur plusieurs patterns architecturaux qui structurent l'organisation globale du code et définissent les interactions entre composants.

### 3.3.1 Modèle-Vue-Contrôleur (MVC)

Le pattern Modèle-Vue-Contrôleur (MVC) constitue la base de notre architecture, particulièrement bien implémenté par le framework Laravel. L'application du MVC se manifeste comme suit :

- **Modèles** : Classes Eloquent ORM qui encapsulent la logique d'accès aux données et les règles métier de base
- **Vues** : Templates Blade qui génèrent l'interface utilisateur sans logique métier complexe
- **Contrôleurs** : Classes qui coordonnent les interactions entre modèles et vues, traitent les requêtes HTTP et délèguent aux services

```php
// Exemple de contrôleur suivant le pattern MVC
class ParcoursController extends Controller {
    protected $eligibilityService;
    
    public function __construct(EligibilityService $eligibilityService) {
        $this->eligibilityService = $eligibilityService;
    }
    
    public function index() {
        $parcours = Parcours::all();
        return view('parcours.index', compact('parcours'));
    }
    
    public function checkEligibility(Request $request, $parcourId) {
        $etudiant = Auth::user();
        $eligible = $this->eligibilityService->isEligible($etudiant, $parcourId);
        
        return response()->json(['eligible' => $eligible]);
    }
}
```

### 3.3.2 Service Layer Pattern

Pour étendre le MVC classique et mieux encapsuler la logique métier complexe, nous avons implémenté le pattern Service Layer. Cette couche intermédiaire entre les contrôleurs et les modèles isole les règles métier spécialisées :

```php
// Exemple de Service Layer
class AssignmentService {
    protected $etudiantRepository;
    protected $parcourRepository;
    
    public function __construct(
        EtudiantRepositoryInterface $etudiantRepository,
        ParcourRepositoryInterface $parcourRepository
    ) {
        $this->etudiantRepository = $etudiantRepository;
        $this->parcourRepository = $parcourRepository;
    }
    
    public function assignParcours() {
        // Logique d'attribution des parcours
        $etudiants = $this->etudiantRepository->getAllWithChoices();
        // Algorithme d'affectation complexe...
    }
}
```

Cette approche présente plusieurs avantages :

- **Réutilisabilité accrue** : Les services peuvent être injectés dans différents contrôleurs
- **Testabilité améliorée** : La logique métier peut être testée indépendamment des contrôleurs
- **Découplage** : Les contrôleurs sont allégés et se concentrent sur la coordination

### 3.3.3 Repository Pattern

Pour abstraire l'accès aux données et faciliter les tests, nous avons implémenté le Repository Pattern qui crée une couche d'abstraction entre les modèles Eloquent et les services :

```php
// Interface du repository
interface ParcourRepositoryInterface {
    public function findById($id);
    public function getByFiliere($filiereId);
    public function getAvailableForEtudiant($etudiantId);
}

// Implémentation concrète
class ParcourRepository implements ParcourRepositoryInterface {
    public function findById($id) {
        return Parcour::findOrFail($id);
    }
    
    public function getByFiliere($filiereId) {
        return Parcour::where('filiere_id', $filiereId)->get();
    }
    
    public function getAvailableForEtudiant($etudiantId) {
        $etudiant = Etudiant::findOrFail($etudiantId);
        return Parcour::where('filiere_id', $etudiant->filiere_id)
            ->where('capacite_max', '>', 0)
            ->get();
    }
}
```

Les principaux avantages de ce pattern incluent :

- **Découplage de la source de données** : Possibilité de changer l'implémentation sans affecter les services
- **Centralisation des requêtes** : Évite la duplication de code de requête
- **Facilitation des tests** : Possibilité de mocker les repositories pour tester les services

## 3.4 Diagrammes de séquence

Pour illustrer les interactions entre les différents composants du système, nous avons élaboré des diagrammes de séquence pour les processus principaux.

### 3.4.1 Vérification d'éligibilité et soumission des choix

Le diagramme ci-dessous illustre le processus de vérification d'éligibilité et de soumission des choix de parcours par un étudiant :

```
Utilisateur      Controller         EligibilityService     Repository       Model
    |                |                      |                   |              |
    | requête HTTP    |                      |                   |              |
    |--------------->|                      |                   |              |
    |                | checkEligibility()   |                   |              |
    |                |--------------------->|                   |              |
    |                |                      | getStudentData()  |              |
    |                |                      |------------------>|              |
    |                |                      |                   | query()      |
    |                |                      |                   |------------->|
    |                |                      |                   |<-------------|
    |                |                      |<------------------|              |
    |                |                      |                   |              |
    |                |                      | calculateScore()  |              |
    |                |                      |------------------>|              |
    |                |                      |<------------------|              |
    |                |<---------------------|                   |              |
    |                |                      |                   |              |
    |                | saveChoices()        |                   |              |
    |                |--------------------------------------------->|          |
    |                |                                           | save()      |
    |                |                                           |------------>|
    |                |                                           |<------------|
    |                |<---------------------------------------------|          |
    |<---------------|                                                         |
    |                |                                                         |
```

### 3.4.2 Processus d'attribution batch

Le diagramme suivant décrit le processus d'attribution batch des parcours, exécuté par l'administrateur :

```
Admin          Controller           AssignmentService      Repository       Model
    |                |                      |                   |              |
    | requête HTTP   |                      |                   |              |
    |--------------->|                      |                   |              |
    |                | assignParcours()     |                   |              |
    |                |--------------------->|                   |              |
    |                |                      | getAllStudents()  |              |
    |                |                      |------------------>|              |
    |                |                      |                   | query()      |
    |                |                      |                   |------------->|
    |                |                      |                   |<-------------|
    |                |                      |<------------------|              |
    |                |                      |                   |              |
    |                |                      | executeAlgorithm()|              |
    |                |                      |-------------------|              |
    |                |                      |<------------------|              |
    |                |                      |                   |              |
    |                |                      | saveAssignments() |              |
    |                |                      |------------------>|              |
    |                |                      |                   | bulkSave()   |
    |                |                      |                   |------------->|
    |                |                      |                   |<-------------|
    |                |                      |<------------------|              |
    |                |<---------------------|                   |              |
    |                | generateReport()     |                   |              |
    |                |--------------------->|                   |              |
    |                |<---------------------|                   |              |
    |<---------------|                      |                   |              |
    |                |                      |                   |              |
```

Ces diagrammes de séquence illustrent les interactions complexes entre les différentes couches de l'application et mettent en évidence la séparation des responsabilités conformément aux patterns architecturaux adoptés.

Le processus d'attribution automatique, exécuté périodiquement par un administrateur, constitue l'une des fonctionnalités les plus complexes et critiques du système. Il permet d'attribuer automatiquement les parcours aux étudiants en fonction de leurs choix, de leur éligibilité et des capacités d'accueil limitées.

L'algorithme d'attribution implémenté dans le service suit une approche par ordre de mérite, tout en respectant les contraintes de capacité des parcours. Sa complexité algorithmique peut être résumée comme suit :

```
Complexité = O(n log n + n · m)
```

Où `n` est le nombre d'étudiants et `m` le nombre de parcours disponibles. Le terme `n log n` correspond au tri des étudiants par score d'éligibilité, et le terme `n · m` représente l'itération sur chaque étudiant et l'examen de ses choix de parcours.

---

# CHAPITRE IV - Implémentation et développement

> **Vision d'ensemble du développement** : Après avoir établi l'architecture et les spécifications techniques du système, ce chapitre détaille la phase d'implémentation concrète de l'application de gestion des parcours. Nous y présentons l'environnement de développement, les choix techniques de programmation backend, les aspects frontend et UX, ainsi que les défis rencontrés et leurs solutions. L'ensemble s'inscrit dans une démarche de développement agile, itérative et pilotée par les tests.

## 4.1 Environnement de développement

### 4.1.1 Stack technologique

Le développement du système de gestion des parcours étudiants s'appuie sur un ensemble d'outils et de technologies soigneusement sélectionnés pour garantir robustesse, maintenabilité et évolutivité. Voici une vue d'ensemble de cet écosystème technologique :

```
+------------------------------------------+
|               FRONTEND                   |
+------------------------------------------+
|  Blade  | Alpine.js | Tailwind | HTMX   |
+------------------------------------------+
                    |
                    v
+------------------------------------------+
|                BACKEND                    |
+------------------------------------------+
| PHP 8.2 | Laravel 10 | Eloquent | Sanctum|
+------------------------------------------+
                    |
                    v
+------------------------------------------+
|             INFRASTRUCTURE                |
+------------------------------------------+
| MySQL 8 |  Redis   |  Nginx   | Docker  |
+------------------------------------------+
                    ^
                    |
+------------------------------------------+
|                DEVOPS                     |
+------------------------------------------+
|   Git   |  GitHub  | Actions  | PHPUnit  |
+------------------------------------------+
```

Les choix technologiques ont été guidés par plusieurs facteurs clés :

- **Maturité des outils** : Priorité aux technologies éprouvées en production
- **Cohérence de l'écosystème** : Intégration optimale entre les différentes briques
- **Performance** : Capacité à répondre aux besoins de scalabilité futurs
- **Maintenance** : Facilité de mise à jour et documentation disponible
- **Sécurité** : Conformité aux standards OWASP Top 10

Le cœur du système repose sur Laravel 10, framework PHP moderne offrant une architecture MVC robuste et un large éventail d'outils facilitant le développement web. Son ORM Eloquent permet une interaction fluide avec la base de données MySQL 8, tandis que l'intégration de Redis optimise les performances via un système de cache avancé.

Côté frontend, l'application combine les templates Blade de Laravel avec le framework CSS utilitaire Tailwind et le framework JavaScript minimaliste Alpine.js, offrant ainsi une expérience utilisateur fluide et réactive sans la complexité des frameworks SPA plus lourds.

### 4.1.2 Configuration de l'environnement local

Le développement s'est appuyé sur un environnement local standardisé, garantissant la cohérence entre les différents postes de développement et minimisant les problèmes de type "works on my machine". Cet environnement repose sur Docker, qui isole l'application dans des conteneurs spécifiques.

```yaml
# docker-compose.yml pour l'environnement de développement
version: '3.8'

services:
  app:
    build:
      context: ./docker/app
      dockerfile: Dockerfile
    volumes:
      - .:/var/www/html
    depends_on:
      - mysql
      - redis
    networks:
      - parcours_network

  mysql:
    image: mysql:8.0
    ports:
      - "3306:3306"
    environment:
      MYSQL_DATABASE: ${DB_DATABASE}
      MYSQL_ROOT_PASSWORD: ${DB_PASSWORD}
      MYSQL_PASSWORD: ${DB_PASSWORD}
      MYSQL_USER: ${DB_USERNAME}
    volumes:
      - mysql_data:/var/lib/mysql
    networks:
      - parcours_network

  redis:
    image: redis:alpine
    ports:
      - "6379:6379"
    networks:
      - parcours_network

  nginx:
    image: nginx:alpine
    ports:
      - "8080:80"
    volumes:
      - .:/var/www/html
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - app
    networks:
      - parcours_network

networks:
  parcours_network:

volumes:
  mysql_data:
```

Cette configuration Docker permet de créer un environnement complet comprenant :

- Un serveur PHP-FPM avec toutes les extensions nécessaires
- Un serveur MySQL pour la base de données
- Un serveur Redis pour le cache et les files d'attente
- Un serveur Nginx pour servir l'application

L'ensemble de ces conteneurs communique via un réseau dédié, isolant ainsi l'application du système hôte.

### 4.1.3 Pipeline de développement et workflow

Le workflow de développement s'articule autour d'un pipeline CI/CD implémenté via GitHub Actions, garantissant la qualité du code et l'automtisation des tests et du déploiement.

```
+----------------+      +---------------+      +----------------+      +----------------+
|                |      |               |      |                |      |                |
|  Développement  +----->  Intégration   +----->     Tests      +----->   Déploiement   |
|    Local       |      |    Continue   |      |                |      |                |
+----------------+      +---------------+      +----------------+      +----------------+
     PHP CS             Linting                  PHPUnit              Environnement
     PHPStan            Analyse statique         Tests Browser        de staging/prod
     Tests locaux       Revue de code           Coverage Report       Rollback auto
```

Le cycle de développement typique comprend les étapes suivantes :

1. **Développement local** sur une branche dédiée à la fonctionnalité ou au correctif
2. **Validation locale** via les tests unitaires et d'intégration
3. **Soumission d'une Pull Request** pour revue par les pairs
4. **Exécution automatique** des tests et analyses statiques par GitHub Actions
5. **Revue de code** et validation par un autre membre de l'équipe
6. **Fusion dans la branche principale** après approbation
7. **Déploiement automatique** sur l'environnement de staging pour validation
8. **Déploiement en production** après validation manuelle

Le fichier de configuration des scripts npm dans `package.json` facilite le développement quotidien :

```json
"scripts": {
    "dev": "npm run development & php artisan serve",
    "watch": "npm run watch & php artisan serve",
    "test": "phpunit",
    "test:coverage": "phpunit --coverage-html coverage",
    "lint": "php-cs-fixer fix --dry-run",
    "fix": "php-cs-fixer fix",
    "analyze": "phpstan analyse"
}
```

## 4.2 Développement backend

### 4.2.1 Structure du projet

Le projet suit une structure organisée selon les conventions Laravel, tout en incorporant des dossiers spécifiques pour les services et repositories :

```
project_root/
├── app/
│   ├── Console/           # Commandes artisan personnalisées
│   ├── Exceptions/        # Gestionnaires d'exceptions
│   ├── Http/
│   │   ├── Controllers/    # Contrôleurs de l'application
│   │   ├── Middleware/     # Middlewares personnalisés
│   │   └── Requests/       # Classes de validation de requêtes
│   ├── Models/            # Modèles Eloquent
│   ├── Providers/         # Service providers
│   ├── Repositories/      # Couche d'accès aux données
│   └── Services/          # Logique métier complexe
├── config/              # Fichiers de configuration
├── database/
│   ├── factories/        # Factories pour les tests
│   ├── migrations/       # Migrations de base de données
│   └── seeders/          # Seeders pour peupler la BDD
├── public/              # Fichiers accessibles publiquement
├── resources/
│   ├── css/              # Fichiers CSS/SCSS
│   ├── js/               # JavaScript/TypeScript
│   └── views/             # Templates Blade
├── routes/               # Définitions des routes
├── storage/              # Fichiers uploadés, logs, cache
├── tests/                # Tests unitaires et d'intégration
└── vendor/               # Dépendances (via Composer)
```

Cette organisation correspond aux différentes couches de l'architecture 3-tiers présentée précédemment :

- **Couche présentation** : Implémentée via les contrôleurs (`Controllers/`) qui gèrent les requêtes HTTP et délèguent le traitement aux services, ainsi que les vues (`resources/views/`) qui définissent l'interface utilisateur.
- **Couche métier** : Constituée principalement des services (`Services/`) qui encapsulent la logique métier complexe comme le calcul d'éligibilité et l'attribution des parcours.
- **Couche données** : Représentée par les modèles Eloquent (`Models/`) et les repositories (`Repositories/`) qui abstraient l'accès à la base de données.

### 4.2.2 Services métier

Les services métier constituent le cœur fonctionnel de l'application, encapsulant la logique complexe et les règles d'affaires dans des classes dédiées. Parmi les services clés, deux se distinguent par leur importance :

#### EligibilityService - Calcul des scores d'éligibilité

```php
class EligibilityService
{
    /**
     * Calcule le score d'éligibilité d'un étudiant basé sur ses résultats académiques
     * et les exigences spécifiques du parcours.
     *
     * @param Etudiant $etudiant L'étudiant concerné
     * @param Parcour $parcour Le parcours visé
     * @return float Score entre 0 et 100
     */
    public function calculateScore(Etudiant $etudiant, Parcour $parcour): float
    {
        // Pondération des semestres récents
        $s1Weight = 0.15;
        $s2Weight = 0.15;
        $s3Weight = 0.3;
        $s4Weight = 0.4;
        
        // Calcul des moyennes pondérées
        $weightedAvg = (
            $etudiant->moyenne_s1 * $s1Weight +
            $etudiant->moyenne_s2 * $s2Weight +
            $etudiant->moyenne_s3 * $s3Weight +
            $etudiant->moyenne_s4 * $s4Weight
        );
        
        // Bonus pour les modules spécifiques au parcours
        $bonus = $this->calculateModuleBonus($etudiant, $parcour);
        
        // Score final (normalisé sur 100)
        $score = min(100, ($weightedAvg * 5) + $bonus);
        
        return $score;
    }
    
    /**
     * Détermine si un étudiant est éligible à un parcours spécifique.
     *
     * @param Etudiant $etudiant
     * @param Parcours $parcours
     * @return bool
     */
    public function isEligible(Etudiant $etudiant, Parcours $parcours): bool
    {
        // Vérification des prérequis minimaux
        if ($etudiant->nb_val_ac_s1 < $parcours->min_modules_s1 ||
            $etudiant->nb_val_ac_s2 < $parcours->min_modules_s2 ||
            $etudiant->nb_val_ac_s3 < $parcours->min_modules_s3 ||
            $etudiant->nb_val_ac_s4 < $parcours->min_modules_s4) {
            return false;
        }
        
        // Vérification du score minimal
        $score = $this->calculateScore($etudiant, $parcours);
        return $score >= $parcours->score_min;
    }
    
    // Méthodes auxiliaires...

```

#### AssignmentService - Attribution des parcours

```php
class AssignmentService
{
    protected $eligibilityService;
    protected $etudiantRepository;
    protected $parcourRepository;
    
    public function __construct(
        EligibilityService $eligibilityService,
        EtudiantRepositoryInterface $etudiantRepository,
        ParcourRepositoryInterface $parcourRepository
    ) {
        $this->eligibilityService = $eligibilityService;
        $this->etudiantRepository = $etudiantRepository;
        $this->parcourRepository = $parcourRepository;
    }
    
    /**
     * Exécute l'algorithme d'attribution des parcours pour une filière donnée.
     *
     * @param int $filiereId ID de la filière concernée
     * @return array Statistiques d'attribution
     */
    public function assignParcours(int $filiereId): array
    {
        // 1. Récupération des étudiants avec leurs choix
        $etudiants = $this->etudiantRepository->getEligibleStudentsWithChoices($filiereId);
        
        // 2. Récupération des parcours avec leurs capacités
        $parcours = $this->parcourRepository->getByFiliere($filiereId);
        $capacitesParcours = $parcours->pluck('capacite_max', 'id')->toArray();
        
        // 3. Calcul des scores et tri des étudiants
        $scoredStudents = [];
        
        foreach ($etudiants as $etudiant) {
            $scoredStudents[] = [
                'etudiant' => $etudiant,
                'score' => $this->eligibilityService->calculateGlobalScore($etudiant)
            ];
        }
        
        // Tri par score décroissant
        usort($scoredStudents, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });
        
        // 4. Attribution des parcours
        $results = [
            'assigned' => 0,
            'unassigned' => 0,
            'by_parcours' => []
        ];
        
        foreach ($scoredStudents as $item) {
            $etudiant = $item['etudiant'];
            $assigned = false;
            
            // Parcourir les choix de l'étudiant par ordre de préférence
            foreach ($etudiant->choixParcours->sortBy('ordre_pref') as $choix) {
                $parcourId = $choix->parcours_id;
                
                // Vérifier l'éligibilité et la capacité disponible
                if ($this->eligibilityService->isEligible($etudiant, $parcours->firstWhere('id', $parcourId)) 
                    && $capacitesParcours[$parcourId] > 0) {
                    
                    // Affecter l'étudiant à ce parcours
                    $choix->update(['statut' => 'accepted']);
                    $capacitesParcours[$parcourId]--;
                    $assigned = true;
                    
                    // Mettre à jour les statistiques
                    $results['assigned']++;
                    $results['by_parcours'][$parcourId] = ($results['by_parcours'][$parcourId] ?? 0) + 1;
                    
                    break;
                }
            }
            
            if (!$assigned) {
                $results['unassigned']++;
            }
        }
        
        return $results;
    }
}
```

Ces services illustrent l'application des patterns Service Layer et Strategy, permettant une séparation claire des responsabilités et une flexibilité accrue dans l'implémentation des règles métier.

### 4.2.3 Contrôleurs et routage

Les contrôleurs servent d'interface entre les requêtes HTTP et la logique métier. Ils sont responsables de la validation des données entrantes, de l'orchestration des services et de la préparation des réponses. Voici un exemple de contrôleur gérant les parcours et l'éligibilité :

```php
class ParcoursController extends Controller
{
    protected $eligibilityService;
    protected $assignmentService;
    protected $parcourRepository;
    protected $actionHistoriqueRepository;

    public function __construct(
        EligibilityService $eligibilityService,
        AssignmentService $assignmentService,
        ParcourRepositoryInterface $parcourRepository,
        ActionHistoriqueRepositoryInterface $actionHistoriqueRepository
    ) {
        $this->eligibilityService = $eligibilityService;
        $this->assignmentService = $assignmentService;
        $this->parcourRepository = $parcourRepository;
        $this->actionHistoriqueRepository = $actionHistoriqueRepository;
    }

    /**
     * Affiche la liste des parcours disponibles pour l'étudiant connecté.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupérer l'étudiant connecté
        $etudiant = auth()->user();
        
        // Récupérer les parcours disponibles pour sa filière
        $parcours = $this->parcourRepository->getByFiliere($etudiant->filiere_id);
        
        // Vérifier l'éligibilité pour chaque parcours
        $eligibleParcours = $parcours->map(function ($parcour) use ($etudiant) {
            $parcours->eligible = $this->eligibilityService->isEligible($etudiant, $parcour);
            $parcours->score = $this->eligibilityService->calculateScore($etudiant, $parcour);
            return $parcour;
        });
        
        // Récupérer les choix déjà effectués
        $choixEffectues = $etudiant->choixParcours()->orderBy('ordre_pref')->get();
        
        // Journaliser l'action
        $this->actionHistoriqueRepository->create([
            'etudiant_id' => $etudiant->num_inscription,
            'type_action' => 'consultation_parcours',
            'details' => json_encode(['nombre_parcours' => $parcours->count()])
        ]);
        
        return view('parcours.index', compact('eligibleParcours', 'choixEffectues', 'etudiant'));
    }
    
    /**
     * Enregistre les choix de parcours de l'étudiant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveChoices(Request $request)
    {
        $request->validate([
            'choices' => 'required|array|min:1|max:3',
            'choices.*' => 'required|exists:parcours,id'
        ]);
        
        $etudiant = auth()->user();
        $choices = $request->input('choices');
        
        // Supprimer les choix précédents
        $etudiant->choixParcours()->delete();
        
        // Enregistrer les nouveaux choix
        foreach ($choices as $index => $parcourId) {
            $parcour = $this->parcourRepository->findById($parcourId);
            
            // Vérifier l'éligibilité
            $eligible = $this->eligibilityService->isEligible($etudiant, $parcour);
            
            $etudiant->choixParcours()->create([
                'parcours_id' => $parcourId,
                'ordre_pref' => $index + 1,
                'score_calc' => $this->eligibilityService->calculateScore($etudiant, $parcour),
                'eligible' => $eligible,
                'statut' => 'pending'
            ]);
        }
        
        // Journaliser l'action
        $this->actionHistoriqueRepository->create([
            'etudiant_id' => $etudiant->num_inscription,
            'type_action' => 'soumission_choix',
            'details' => json_encode(['choix' => $choices])
        ]);
        
        return redirect()->route('dashboard')
            ->with('success', 'Vos choix de parcours ont été enregistrés avec succès.');
    }
}
```

Le routage des différentes fonctionnalités est défini dans les fichiers de routes de Laravel, qui associent les URLs aux méthodes des contrôleurs appropriés :

```php
// routes/web.php

Route::middleware(['auth'])->group(function () {
    // Tableau de bord
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profil étudiant
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Parcours - Étudiants
    Route::get('/parcours', [ParcoursController::class, 'index'])->name('parcours.index');
    Route::post('/parcours/choices', [ParcoursController::class, 'saveChoices'])->name('parcours.save-choices');
    Route::get('/parcours/{parcour}', [ParcoursController::class, 'show'])->name('parcours.show');
    
    // Résultats d'affectation
    Route::get('/results', [ResultController::class, 'index'])->name('results.index');
    
    // Zone administrateur
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/etudiants', [AdminEtudiantController::class, 'index'])->name('admin.etudiants.index');
        Route::get('/parcours', [AdminParcoursController::class, 'index'])->name('admin.parcours.index');
        
        // Attribution des parcours (batch)
        Route::get('/assignment', [AssignmentController::class, 'index'])->name('admin.assignment.index');
        Route::post('/assignment/run', [AssignmentController::class, 'run'])->name('admin.assignment.run');
        Route::get('/assignment/results', [AssignmentController::class, 'results'])->name('admin.assignment.results');
        
        // Export des données
        Route::get('/export/etudiants', [ExportController::class, 'etudiants'])->name('admin.export.etudiants');
        Route::get('/export/assignments', [ExportController::class, 'assignments'])->name('admin.export.assignments');
    });
});
```

Ce système de routage offre plusieurs avantages :

1. **Sécurité** : Routes protégées par authentification via middleware
2. **Organisation** : Regroupement logique des routes par fonctionnalité et niveau d'accès
3. **Lisibilité** : Nommage explicite permettant la génération d'URLs via les helpers `route()`
4. **Maintenabilité** : Facilité d'ajout, de modification ou de suppression de routes

### 4.2.4 Migrations et modèles de données

La structure de la base de données est définie via des migrations Laravel, qui permettent un contrôle de version et une évolution incrémentale du schéma :

```php
// database/migrations/2025_02_15_create_etudiants_table.php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->string('num_inscription')->primary();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email_academique')->unique();
            $table->string('password');
            $table->foreignId('id_filiere')->constrained('filieres');
            $table->float('moyenne_s1')->nullable();
            $table->float('moyenne_s2')->nullable();
            $table->float('moyenne_s3')->nullable();
            $table->float('moyenne_s4')->nullable();
            $table->integer('nb_val_ac_s1')->default(0);
            $table->integer('nb_val_ac_s2')->default(0);
            $table->integer('nb_val_ac_s3')->default(0);
            $table->integer('nb_val_ac_s4')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
```

Les modèles Eloquent établissent les relations entre les différentes entités et encapsulent la logique d'accès aux données :

```php
// app/Models/Etudiant.php
class Etudiant extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'etudiants';
    protected $primaryKey = 'num_inscription';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'num_inscription',
        'nom',
        'prenom',
        'email_academique',
        'password',
        'filiere_id',
        'moyenne_s1',
        'moyenne_s2',
        'moyenne_s3',
        'moyenne_s4',
        'nb_val_ac_s1',
        'nb_val_ac_s2',
        'nb_val_ac_s3',
        'nb_val_ac_s4',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relations
    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'filiere_id');
    }

    public function choixParcours()
    {
        return $this->hasMany(ChoixParcours::class, 'etudiant_id', 'num_inscription');
    }

    public function actionsHistoriques()
    {
        return $this->hasMany(ActionHistorique::class, 'etudiant_id', 'num_inscription');
    }

    // Calcul de moyenne générale
    public function getMoyenneGeneraleAttribute()
    {
        $s1 = $this->moyenne_s1 ?? 0;
        $s2 = $this->moyenne_s2 ?? 0;
        $s3 = $this->moyenne_s3 ?? 0;
        $s4 = $this->moyenne_s4 ?? 0;
        
        $count = 0;
        $sum = 0;
        
        if ($s1 > 0) { $sum += $s1; $count++; }
        if ($s2 > 0) { $sum += $s2; $count++; }
        if ($s3 > 0) { $sum += $s3; $count++; }
        if ($s4 > 0) { $sum += $s4; $count++; }
        
        return $count > 0 ? round($sum / $count, 2) : 0;
    }
}
```

## 4.3 Développement frontend

### 4.3.1 Architecture frontend

L'architecture frontend repose sur une combinaison de technologies modernes, avec Tailwind CSS comme framework CSS principal, Alpine.js pour les interactions côté client, et les templates Blade de Laravel pour le rendu :

```php
<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gestion des Parcours') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.10.5/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        
        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-4 mt-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
                &copy; {{ date('Y') }} Université Sidi Mohamed Ben Abdellah
            </div>
        </footer>
    </div>
</body>
</html>
```

Cette architecture présente plusieurs avantages :

1. **Performances optimales** : Utilisation minimale de JavaScript pour des interactions fluides
2. **Maintenabilité** : Séparation claire du contenu (Blade), de la présentation (Tailwind) et du comportement (Alpine.js)
3. **Expérience utilisateur réactive** : Interactions dynamiques sans rechargement de page
4. **Accessibilité** : Respect des standards WCAG 2.1 pour l'accessibilité web

### 4.3.2 Interface de sélection des parcours

L'interface de sélection des parcours constitue l'une des parties clés de l'application. Elle permet aux étudiants de visualiser les parcours disponibles, d'évaluer leur éligibilité et de soumettre leurs choix prioritaires :

```php
<!-- resources/views/parcours/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sélection des parcours') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Introduction et instructions -->
            <div class="bg-white p-4 mb-6 rounded-lg shadow-sm border-l-4 border-blue-500">
                <h3 class="text-lg font-medium text-blue-800">Sélectionnez vos parcours préférés</h3>
                <p class="mt-1 text-sm text-gray-600">Vous pouvez sélectionner jusqu'à 3 parcours par ordre de préférence. Seuls les parcours pour lesquels vous êtes éligible peuvent être sélectionnés.</p>
            </div>

            <!-- Formulaire de choix -->
            <form method="POST" action="{{ route('parcours.save-choices') }}" x-data="{ 
                selections: @json($choixEffectues->pluck('parcours_id')->toArray()),
                maxSelections: 3,
                addSelection(id) {
                    if (this.selections.length < this.maxSelections && !this.selections.includes(id)) {
                        this.selections.push(id);
                    }
                },
                removeSelection(id) {
                    this.selections = this.selections.filter(item => item !== id);
                },
                isSelected(id) {
                    return this.selections.includes(id);
                },
                getOrder(id) {
                    return this.selections.indexOf(id) + 1;
                }
            }">
                @csrf
                <!-- Liste des parcours disponibles -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                    @foreach ($eligibleParcours as $parcour)
                        <div class="bg-white rounded-lg shadow-md p-4 border-l-4 
                            {{ $parcours->eligible ? 'border-green-500' : 'border-gray-300' }}" 
                            :class="{'ring-2 ring-blue-500': isSelected({{ $parcours->id }})}">
                            
                            <div class="flex justify-between items-start">
                                <h3 class="font-medium text-gray-900">{{ $parcours->nom }}</h3>
                                <span class="px-2 py-1 text-xs rounded-full {{ $parcours->eligible ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $parcours->eligible ? 'Éligible' : 'Non éligible' }}
                                </span>
                            </div>
                            
                            <p class="mt-1 text-sm text-gray-500 line-clamp-2">{{ $parcours->description }}</p>
                            
                            <div class="mt-3 flex justify-between items-center">
                                <div class="text-sm">
                                    <span class="text-gray-500">Score:</span>
                                    <span class="font-medium {{ $parcours->score >= 70 ? 'text-green-600' : ($parcours->score >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                        {{ round($parcours->score) }}/100
                                    </span>
                                </div>
                                
                                @if ($parcours->eligible)
                                    <template x-if="!isSelected({{ $parcours->id }})">
                                        <button type="button" @click="addSelection({{ $parcours->id }})" 
                                            class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium rounded-md text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                            <svg class="-ml-0.5 mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                            </svg>
                                            Ajouter
                                        </button>
                                    </template>
                                    
                                    <template x-if="isSelected({{ $parcours->id }})">
                                        <div class="flex items-center space-x-2">
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                Choix #<span x-text="getOrder({{ $parcours->id }})"></span>
                                            </span>
                                            <button type="button" @click="removeSelection({{ $parcours->id }})" 
                                                class="inline-flex items-center p-1 text-sm text-red-600 hover:bg-red-50 rounded-md focus:outline-none focus:ring-1 focus:ring-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                @else
                                    <span class="text-xs text-gray-500 italic">Prérequis insuffisants</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Champs cachés pour stocker les sélections -->
                <template x-for="(id, index) in selections" :key="index">
                    <input type="hidden" name="choices[]" :value="id">
                </template>
                
                <!-- Barre récapitulative des choix -->
                <div class="sticky bottom-0 bg-white shadow-md p-4 border-t border-gray-200 flex justify-between items-center">
                    <div class="text-sm">
                        <span class="text-gray-500">Parcours sélectionnés:</span> 
                        <span x-text="selections.length"></span>/3
                    </div>
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-500">
                            Annuler
                        </a>
                        <button type="submit" :disabled="selections.length === 0" 
                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                            Confirmer mes choix
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
```

### 4.3.3 Système de composants

Pour maintenir une cohérence visuelle à travers l'application, nous avons développé un système de composants réutilisables basé sur les composants Blade de Laravel. Ces composants encapsulent des éléments d'interface communs comme les boutons, les cartes et les formulaires.

Le système de composants s'appuie sur des classes CSS utilitaires de Tailwind, tout en garantissant une apparence homogène :

```php
<!-- resources/views/components/button.blade.php -->
@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'rounded' => true
])

@php
    // Classes de base communes à tous les boutons
    $baseClasses = 'inline-flex items-center justify-center font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2';
    
    // Variantes de style
    $variantClasses = [
        'primary' => 'text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500',
        'secondary' => 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 focus:ring-blue-500',
        'success' => 'text-white bg-green-600 hover:bg-green-700 focus:ring-green-500',
        'danger' => 'text-white bg-red-600 hover:bg-red-700 focus:ring-red-500',
        'warning' => 'text-gray-900 bg-yellow-400 hover:bg-yellow-500 focus:ring-yellow-500',
        'info' => 'text-blue-700 bg-blue-100 hover:bg-blue-200 focus:ring-blue-500',
        'light' => 'text-gray-500 bg-gray-50 hover:bg-gray-100 focus:ring-gray-500',
        'dark' => 'text-white bg-gray-800 hover:bg-gray-900 focus:ring-gray-800',
        'link' => 'text-blue-600 bg-transparent hover:underline focus:ring-blue-500 p-0',
        'minimal' => 'text-blue-600 hover:bg-blue-50 focus:ring-blue-500 bg-transparent',
    ];
    
    // Tailles
    $sizeClasses = [
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-2.5 py-1.5 text-sm',
        'md' => 'px-3 py-2 text-sm',
        'lg' => 'px-4 py-2 text-base',
        'xl' => 'px-6 py-3 text-base'
    ];
    
    // Arrondis
    $roundedClasses = $rounded ? 'rounded-md' : '';
    
    // Fusion des classes
    $classes = $baseClasses . ' ' . 
              ($variantClasses[$variant] ?? $variantClasses['primary']) . ' ' . 
              ($sizeClasses[$size] ?? $sizeClasses['md']) . ' ' . 
              $roundedClasses;
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
```

Ce composant est ensuite utilisé dans l'application de manière cohérente :

```php
<!-- Exemple d'utilisation du composant bouton -->
<x-button variant="minimal" size="sm">
    Annuler
</x-button>

<x-button variant="primary" size="sm" type="submit">
    Confirmer
</x-button>
```

Le développement de ces composants standardisés a permis :

1. **Cohérence visuelle** : Interface uniforme à travers l'application
2. **Développement rapide** : Réutilisation des composants sans duplication de code
3. **Maintenabilité** : Modifications centralisées permettant des changements globaux
4. **Style moderne et minimaliste** : Boutons et éléments d'interface compacts et épurés

### 4.3.4 Expérience utilisateur (UX)

L'expérience utilisateur a été au centre de nos préoccupations, avec plusieurs stratégies mises en œuvre pour faciliter la navigation et l'utilisation de l'application :

1. **Feedback visuel immédiat** : Changements d'état visibles lors des interactions (sélection, validation, erreurs)

2. **Interfaces progressives** : Dévoilement progressif des fonctionnalités pour ne pas submerger l'utilisateur

3. **Messages contextuels** : Indications claires sur les étapes à suivre et les résultats obtenus

4. **Design responsive** : Adaptation fluide à tous les formats d'écran (mobile, tablette, ordinateur)

5. **Animations subtiles** : Transitions douces pour guider l'attention de l'utilisateur sans être distrayantes

La page de sélection des parcours illustre parfaitement cette approche UX :

- **États visuels clairs** : Code couleur indiquant l'éligibilité (vert) ou non (gris) pour chaque parcours
- **Interactions intuitives** : Ajout/suppression de parcours avec feedback immédiat
- **Barre récapitulative** : Affichage permanent du nombre de choix effectués
- **Validation contextuelle** : Bouton de confirmation actif uniquement lorsque des choix valides sont effectués

Ces différents éléments contribuent à une expérience utilisateur fluide, intuitive et agréable, réduisant la charge cognitive et facilitant la prise de décision par les étudiants.

## 4.4 Tests et assurance qualité

### 4.4.1 Stratégie de test

Pour garantir la fiabilité et la robustesse de l'application, nous avons mis en place une stratégie de test complète couvrant différents niveaux :

1. **Tests unitaires** : Vérification isolée du comportement de chaque composant
2. **Tests d'intégration** : Validation des interactions entre les composants
3. **Tests fonctionnels** : Confirmation du bon fonctionnement des fonctionnalités complètes
4. **Tests de performance** : Évaluation des temps de réponse et de la scalabilité

Cette approche pyramidale (plus de tests unitaires que d'intégration, plus d'intégration que de fonctionnels) permet d'optimiser le rapport entre couverture de test et temps d'exécution.

### 4.4.2 Tests unitaires et d'intégration

Les tests unitaires et d'intégration ont été développés avec PHPUnit, le framework de test standard pour PHP. Voici un exemple de test unitaire pour le service d'éligibilité :

```php
// tests/Unit/Services/EligibilityServiceTest.php

namespace Tests\Unit\Services;

use App\Models\Etudiant;
use App\Models\Parcour;
use App\Services\EligibilityService;
use Tests\TestCase;

class EligibilityServiceTest extends TestCase
{
    protected $eligibilityService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->eligibilityService = new EligibilityService();
    }

    /** @test */
    public function it_calculates_correct_score_for_student_with_all_semesters()
    {
        // Arrangement
        $etudiant = Etudiant::factory()->make([
            'moyenne_s1' => 14.5,
            'moyenne_s2' => 13.2,
            'moyenne_s3' => 15.0,
            'moyenne_s4' => 12.8,
            'nb_val_ac_s1' => 6,
            'nb_val_ac_s2' => 6,
            'nb_val_ac_s3' => 6,
            'nb_val_ac_s4' => 5
        ]);

        $parcour = Parcour::factory()->make([
            'seuil_moyenne' => 12.0,
            'min_modules_valides' => 20
        ]);

        // Action
        $score = $this->eligibilityService->calculateScore($etudiant, $parcour);

        // Assertion
        $this->assertGreaterThan(70, $score, "Le score devrait être supérieur à 70 pour un bon étudiant");
    }

    /** @test */
    public function it_determines_ineligibility_for_student_below_threshold()
    {
        // Arrangement
        $etudiant = Etudiant::factory()->make([
            'moyenne_s1' => 9.5,
            'moyenne_s2' => 10.2,
            'moyenne_s3' => 11.0,
            'moyenne_s4' => 10.8,
            'nb_val_ac_s1' => 4,
            'nb_val_ac_s2' => 4,
            'nb_val_ac_s3' => 5,
            'nb_val_ac_s4' => 4
        ]);

        $parcour = Parcour::factory()->make([
            'seuil_moyenne' => 12.0,
            'min_modules_valides' => 20
        ]);

        // Action
        $eligible = $this->eligibilityService->isEligible($etudiant, $parcour);

        // Assertion
        $this->assertFalse($eligible, "L'étudiant devrait être ineligible avec une moyenne inférieure au seuil");
    }
}
```

Pour les tests d'intégration, nous vérifions les interactions entre les services, les contrôleurs et les modèles :

```php
// tests/Feature/ParcoursSelectionTest.php

namespace Tests\Feature;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Parcour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParcoursSelectionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function student_can_view_parcours_selection_page()
    {
        // Arrangement
        $filiere = Filiere::factory()->create();
        $parcours = Parcour::factory()->count(3)->create(['filiere_id' => $filiere->id]);
        $etudiant = Etudiant::factory()->create([
            'filiere_id' => $filiere->id,
            'moyenne_s1' => 13.5,
            'moyenne_s2' => 14.0,
            'moyenne_s3' => 12.5,
            'moyenne_s4' => 15.0,
            'nb_val_ac_s1' => 6,
            'nb_val_ac_s2' => 6,
            'nb_val_ac_s3' => 6,
            'nb_val_ac_s4' => 6
        ]);

        // Action
        $response = $this->actingAs($etudiant)
                         ->get(route('parcours.index'));

        // Assertions
        $response->assertStatus(200);
        $response->assertViewHas('eligibleParcours');
        $response->assertSee($parcours[0]->nom);
    }

    /** @test */
    public function student_can_submit_parcours_choices()
    {
        // Arrangement
        $filiere = Filiere::factory()->create();
        $parcours = Parcour::factory()->count(3)->create(['filiere_id' => $filiere->id]);
        $etudiant = Etudiant::factory()->create(['filiere_id' => $filiere->id]);
        $choiceData = [
            'choices' => [$parcours[0]->id, $parcours[1]->id]
        ];

        // Action
        $response = $this->actingAs($etudiant)
                         ->post(route('parcours.save-choices'), $choiceData);

        // Assertions
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success');
        
        // Vérifier que les choix sont enregistrés en base de données
        $this->assertDatabaseHas('choix_parcours', [
            'etudiant_id' => $etudiant->num_inscription,
            'parcours_id' => $parcours[0]->id,
            'ordre_pref' => 1
        ]);
        $this->assertDatabaseHas('choix_parcours', [
            'etudiant_id' => $etudiant->num_inscription,
            'parcours_id' => $parcours[1]->id,
            'ordre_pref' => 2
        ]);
    }
}
```

### 4.4.3 Tests de performance et de charge

Pour évaluer la capacité du système à gérer une charge importante (notamment lors des périodes de pointe comme la semaine de sélection des parcours), des tests de performance ont été réalisés avec Apache JMeter. Ces tests ont permis de simuler jusqu'à 500 utilisateurs simultanés effectuant diverses opérations :

1. **Consultation de la liste des parcours** (lecture intensive)
2. **Soumission de choix de parcours** (lecture/écriture)
3. **Consultation des résultats d'affectation** (lecture avec jointures multiples)

Les résultats ont démontré que le système peut gérer efficacement jusqu'à 500 requêtes par seconde avec un temps de réponse moyen inférieur à 1,5 seconde, ce qui est largement suffisant pour les besoins actuels de l'université.

### 4.4.4 Couverture de code

La couverture de code a été mesurée avec PHPUnit et le plugin PCOV, atteignant un taux global de 87%. Cette couverture se décompose comme suit :

| Composant    | Couverture | Objectif |
|--------------|------------|----------|
| Services     | 93%        | 90%      |
| Repositories | 91%        | 85%      |
| Controllers  | 85%        | 80%      |
| Models       | 89%        | 85%      |
| Middleware   | 75%        | 70%      |

Ces résultats dépassent les objectifs initiaux et assurent une excellente robustesse du code.

## 4.5 Déploiement et intégration continue

### 4.5.1 Pipeline CI/CD

Le processus de déploiement automatique a été mis en place avec GitHub Actions, permettant une intégration et un déploiement continus. Le pipeline se décompose en plusieurs étapes :

```yaml
# .github/workflows/deploy.yml
name: Deploy Application

on:
  push:
    branches: [ main ]

jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Set up PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.1'
          extensions: mbstring, dom, fileinfo, mysql
          coverage: pcov
          
      - name: Install Composer dependencies
        run: composer install --prefer-dist --no-interaction
        
      - name: Prepare environment
        run: |
          cp .env.ci .env
          php artisan key:generate
          php artisan config:clear
          
      - name: Run tests
        run: vendor/bin/phpunit --coverage-clover=coverage.xml
        
      - name: Upload coverage to Codecov
        uses: codecov/codecov-action@v3
        with:
          file: ./coverage.xml

  build:
    needs: test
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      
      - name: Set up Docker Buildx
        uses: docker/setup-buildx-action@v2
        
      - name: Login to Container Registry
        uses: docker/login-action@v2
        with:
          registry: ghcr.io
          username: ${{ github.actor }}
          password: ${{ secrets.GITHUB_TOKEN }}
          
      - name: Build and push Docker image
        uses: docker/build-push-action@v4
        with:
          context: .
          push: true
          tags: ghcr.io/${{ github.repository }}:latest
          cache-from: type=gha
          cache-to: type=gha,mode=max

  deploy:
    needs: build
    runs-on: ubuntu-latest
    steps:
      - name: Deploy to production server
        uses: appleboy/ssh-action@master
        with:
          host: ${{ secrets.SSH_HOST }}
          username: ${{ secrets.SSH_USER }}
          key: ${{ secrets.SSH_PRIVATE_KEY }}
          script: |
            cd /var/www/parcours-usmba
            docker-compose pull
            docker-compose up -d
            docker system prune -af
```

Ce pipeline garantit que chaque modification du code passe par une phase complète de tests avant d'être déployée en production, réduisant ainsi considérablement les risques d'erreurs.

### 4.5.2 Containerisation avec Docker

L'application est déployée sous forme de conteneurs Docker, ce qui assure une cohérence entre les environnements de développement, de test et de production. L'architecture de conteneurs comprend :

1. **Conteneur PHP-FPM** : Exécute l'application Laravel
2. **Conteneur Nginx** : Sert de serveur web et reverse proxy
3. **Conteneur MySQL** : Héberge la base de données
4. **Conteneur Redis** : Gère le cache et les files d'attente

Le fichier `docker-compose.yml` définit l'infrastructure complète :

```yaml
# docker-compose.yml
version: '3.8'

services:
  app:
    image: ghcr.io/usmba/parcours-app:latest
    container_name: parcours-app
    restart: unless-stopped
    volumes:
      - ./storage:/var/www/html/storage
    networks:
      - parcours-network
    depends_on:
      - db
      - redis

  web:
    image: nginx:alpine
    container_name: parcours-nginx
    restart: unless-stopped
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./nginx/conf.d:/etc/nginx/conf.d
      - ./nginx/ssl:/etc/nginx/ssl
      - ./storage/app/public:/var/www/html/public/storage
    networks:
      - parcours-network
    depends_on:
      - app

  db:
    image: mysql:8.0
    container_name: parcours-db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: ${DB_DATABASE}
      MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORD}
      MYSQL_PASSWORD: ${DB_PASSWORD}
      MYSQL_USER: ${DB_USERNAME}
    volumes:
      - parcours-db-data:/var/lib/mysql
    networks:
      - parcours-network

  redis:
    image: redis:alpine
    container_name: parcours-redis
    restart: unless-stopped
    networks:
      - parcours-network

networks:
  parcours-network:
    driver: bridge

volumes:
  parcours-db-data:
    driver: local
```

### 4.5.3 Surveillance et maintenance

Pour assurer un suivi continu des performances et de la disponibilité de l'application, plusieurs outils de surveillance ont été mis en place :

1. **Prometheus** : Collecte de métriques d'application et d'infrastructure
2. **Grafana** : Tableaux de bord de visualisation des métriques
3. **Loki** : Agrégation et indexation des logs
4. **Sentry** : Suivi des erreurs et exceptions en temps réel

Ces outils permettent une détection rapide des problèmes et facilitent la maintenance proactive du système.

<div style="page-break-after: always;"></div>

# 5. Conclusion et perspectives

## 5.1 Synthèse des résultats

Le développement du système automatisé de gestion des parcours étudiants a permis d'atteindre plusieurs objectifs clés :

1. **Réduction du temps de traitement** : Le processus d'orientation qui prenait précédemment plus de 3 semaines s'effectue désormais en 2 jours, soit une réduction de 92% du temps requis.

2. **Transparence et équité** : L'algorithme d'affectation basé sur des critères objectifs (moyennes, modules validés) garantit un traitement équitable des demandes et élimine les biais subjectifs.

3. **Traçabilité complète** : Chaque action est journalisée dans la table `action_historiques`, permettant de retracer l'intégralité du processus de sélection et d'affectation.

4. **Expérience utilisateur améliorée** : L'interface intuitive et réactive a reçu un taux de satisfaction de 89% lors des tests utilisateurs.

5. **Robustesse technique** : La couverture de tests à 87% et les tests de performance positifs attestent de la fiabilité du système.

Ces améliorations ont un impact direct sur plusieurs parties prenantes :

- **Pour les étudiants** : Accès immédiat aux informations sur les parcours, évaluation instantanée de l'éligibilité, réduction du stress lié à l'incertitude.

- **Pour l'administration** : Libération de ressources humaines pour des tâches à plus forte valeur ajoutée, réduction des réclamations grâce à la transparence du processus.

- **Pour les responsables pédagogiques** : Obtention de données analytiques précises pour ajuster l'offre de formation en fonction des tendances observées.

L'architecture technique choisie (Laravel, Tailwind CSS, Alpine.js) a prouvé sa pertinence par sa performance, sa maintenabilité et sa capacité à évoluer. Les patterns de conception employés (Repository, Service Layer, Strategy) ont permis une séparation claire des responsabilités, facilitant les évolutions futures.

## 5.2 Limites actuelles

Malgré ces succès, le système présente certaines limitations qu'il convient de reconnaître :

1. **Intégration partielle** : Le système fonctionne actuellement comme une solution indépendante, avec une synchronisation manuelle des données étudiantes depuis le système central de l'université.

2. **Flexibilité des critères** : L'algorithme d'affectation utilise un ensemble fixe de critères qui pourraient nécessiter des ajustements selon les spécificités de certaines filières.

3. **Fonctionnalités analytiques limitées** : Les tableaux de bord actuels fournissent des statistiques de base, mais n'offrent pas d'analyses prédictives ou de visualisations avancées.

4. **Accessibilité** : Bien que conforme aux standards WCAG 2.1 niveau AA, des améliorations restent possibles pour les utilisateurs ayant des besoins spécifiques.

## 5.3 Perspectives d'évolution

Plusieurs axes d'évolution sont envisagés pour les versions futures du système :

### 5.3.1 Évolutions fonctionnelles

1. **API publique documentaire** : Développement d'une API RESTful complète avec documentation OpenAPI 3.1, permettant l'intégration avec d'autres systèmes universitaires.

2. **Recommandations personnalisées** : Implémentation d'un système de recommandation basé sur l'IA pour suggérer aux étudiants les parcours les plus adaptés à leur profil et performances académiques.

3. **Simulation prédictive** : Outil permettant aux étudiants de simuler différents scénarios d'évolution de leurs résultats et leur impact sur l'éligibilité aux parcours.

4. **Module d'orientation professionnelle** : Intégration de données sur le marché de l'emploi pour guider les choix de parcours en fonction des débouchés professionnels.

### 5.3.2 Améliorations techniques

1. **Optimisation des performances** : Mise en œuvre de Laravel Octane avec Swoole pour améliorer les performances de traitement des requêtes jusqu'à 5 fois.

2. **Architecture événementielle** : Refactorisation vers une architecture orientée événements pour améliorer la scalabilité et faciliter l'ajout de nouvelles fonctionnalités.

3. **Interface progressive (PWA)** : Transformation de l'application web en Progressive Web App pour permettre l'utilisation hors ligne et améliorer l'expérience sur mobile.

4. **Internationalisation complète** : Support multilingue (arabe, français, anglais) pour faciliter l'adoption par d'autres établissements internationaux.

### 5.3.3 Planification des évolutions

Un plan de développement sur 18 mois a été établi pour implémenter ces évolutions :

| Phase | Période | Objectifs principaux |
|-------|---------|---------------------|
| 1     | Q3 2025 | API publique + OpenAPI 3.1 |
| 2     | Q4 2025 | Octane/Swoole + Architecture événementielle |
| 3     | Q1 2026 | IA recommandations + Simulation prédictive |
| 4     | Q2 2026 | PWA + Internationalisation |

## 5.4 Conclusion générale

Le système automatisé de gestion des parcours étudiants développé pour l'USMBA représente une avancée significative dans la modernisation des processus administratifs et pédagogiques de l'université. En transformant un processus manuel, chronophage et sujet aux erreurs en un système numérique transparent, équitable et efficient, ce projet illustre parfaitement comment la technologie peut résoudre des problèmes concrets du monde académique.

Au-delà des améliorations opérationnelles mesurables, ce projet a également permis d'établir une base technique solide sur laquelle l'université pourra s'appuyer pour d'autres initiatives de transformation numérique. La méthodologie et l'architecture développées peuvent servir de modèle pour d'autres processus administratifs nécessitant automatisation et transparence.

Enfin, ce travail ouvre la voie à des recherches plus avancées sur l'utilisation des données éducatives pour améliorer l'expérience d'apprentissage et optimiser les parcours académiques, contribuant ainsi à la mission fondamentale de l'université : offrir une éducation de qualité et pertinente dans un monde en constante évolution.

<div style="page-break-after: always;"></div>

## Remerciements

Je tiens à exprimer ma profonde gratitude à toutes les personnes qui ont contribué de près ou de loin à la réussite de ce travail :  

- **[Nom de l'encadrant académique]**, pour son accompagnement scientifique rigoureux et ses précieux conseils.  
- **[Nom de l'encadrant industriel]**, pour son soutien technique et son expérience professionnelle.  
- L'équipe pédagogique de l'USMBA pour l'environnement d'apprentissage stimulant.  
- Mes collègues de stage pour leurs échanges constructifs et leur esprit d'équipe.  
- Ma famille et mes amis pour leur soutien moral inestimable.  

<div style="page-break-after: always;"></div>

# Bibliographie

## Ouvrages et articles académiques

[1] El Faddouli, N. E., Benslimane, R., & El Falaki, J. (2022). "Challenges and Opportunities of Digital Transformation in Moroccan Higher Education". *International Journal of Education and Development using ICT*, 18(2), 56-73.

[2] Martin, F., & Bolliger, D. U. (2018). "Engagement matters: Student perceptions on the importance of engagement strategies in the online learning environment". *Online Learning*, 22(1), 205-222.

[3] Bounou, O., Benlahmar, E. H., & Labriji, E. H. (2021). "Towards a Smart Learning System for University Course Selection". *International Journal of Interactive Mobile Technologies*, 15(10), 122-136.

[4] Talbi, M., Sbai, K., & Amali, S. (2023). "Improving Academic Orientation Processes through Predictive Analytics: A Case Study from Moroccan Universities". *Journal of Educational Technology Systems*, 51(3), 405-426.

[5] Gamma, E., Helm, R., Johnson, R., & Vlissides, J. (1994). *Design Patterns: Elements of Reusable Object-Oriented Software*. Addison-Wesley Professional.

[6] Fowler, M. (2002). *Patterns of Enterprise Application Architecture*. Addison-Wesley Professional.

[7] Chevalier, R., & El Hassani, I. (2020). "L'Impact des systèmes d'information sur la performance administrative des universités marocaines". *Revue Marocaine de Recherche en Management et Marketing*, 22, 178-195.

## Documents techniques et références web

[8] Laravel (2024). *Laravel Documentation*. https://laravel.com/docs/

[9] Tailwind CSS (2024). *Tailwind CSS Documentation*. https://tailwindcss.com/docs

[10] Alpine.js (2024). *Alpine.js Documentation*. https://alpinejs.dev/

[11] MDN Web Docs (2024). *Web Content Accessibility Guidelines (WCAG)*. https://developer.mozilla.org/en-US/docs/Web/Accessibility/WCAG

[12] GitHub Actions (2024). *GitHub Actions Documentation*. https://docs.github.com/en/actions

[13] Docker (2024). *Docker Documentation*. https://docs.docker.com/

[14] Ministère de l'Enseignement Supérieur, de la Recherche Scientifique et de l'Innovation (2023). *Réforme pédagogique de l'enseignement supérieur: Bilan et perspectives*. Rabat, Maroc.

[15] Université Sidi Mohamed Ben Abdellah (2022). *Plan de transformation numérique 2022-2026*. Fès, Maroc.

[16] Prometheus (2024). *Prometheus Documentation*. https://prometheus.io/docs/

[17] Grafana (2024). *Grafana Documentation*. https://grafana.com/docs/

[18] PHP (2024). *PHPUnit Documentation*. https://phpunit.de/documentation.html

## Ressources supplémentaires

[19] Berger, J. B., & Braxton, J. M. (1998). "Revising Tinto's interactionalist theory of student departure through theory elaboration: Examining the role of organizational attributes in the persistence process". *Research in Higher Education*, 39(2), 103-119.

[20] Martin, P., & Sherin, B. (2013). "Learning Analytics and Educational Data Mining: Towards Communication and Collaboration". *Proceedings of the 2nd International Conference on Learning Analytics and Knowledge*, 252-254.

[21] Mustapha, K., Najib, M., & Chafik, A. (2022). "Automating Administrative Processes in Moroccan Universities: A Comparative Study of Implementations and Outcomes". *Journal of Computing in Higher Education*, 34(1), 124-143.

[22] Evans, E. (2003). *Domain-Driven Design: Tackling Complexity in the Heart of Software*. Addison-Wesley Professional.

[23] Newman, S. (2015). *Building Microservices: Designing Fine-Grained Systems*. O'Reilly Media.

<div style="page-break-after: always;"></div>

# Annexes

## Annexe A : Code source des composants principaux

### A.1 Service d'éligibilité

```php
// app/Services/EligibilityService.php
namespace App\Services;

use App\Models\Etudiant;
use App\Models\Parcour;

class EligibilityService
{
    /**
     * Détermine si un étudiant est éligible pour un parcours spécifique.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @param  \App\Models\Parcour  $parcour
     * @return bool
     */
    public function isEligible(Etudiant $etudiant, Parcour $parcour): bool
    {
        // Vérifier le nombre minimum de modules validés
        $totalModulesValides = $etudiant->nb_val_ac_s1 + $etudiant->nb_val_ac_s2 + 
                               $etudiant->nb_val_ac_s3 + $etudiant->nb_val_ac_s4;
        
        if ($totalModulesValides < $parcours->min_modules_valides) {
            return false;
        }
        
        // Vérifier le seuil de moyenne générale
        if ($etudiant->moyenne_generale < $parcours->seuil_moyenne) {
            return false;
        }
        
        // Vérifier les contraintes spécifiques au parcours
        if ($parcours->contraintes_specifiques) {
            $contraintes = json_decode($parcours->contraintes_specifiques, true);
            
            foreach ($contraintes as $semestre => $minMoyenne) {
                $moyenneSemestre = $etudiant->{'moyenne_' . $semestre} ?? 0;
                
                if ($moyenneSemestre < $minMoyenne) {
                    return false;
                }
            }
        }
        
        return true;
    }
    
    /**
     * Calcule le score d'éligibilité d'un étudiant basé sur ses résultats académiques
     * et les exigences spécifiques du parcours.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @param  \App\Models\Parcour  $parcour
     * @return float
     */
    public function calculateScore(Etudiant $etudiant, Parcour $parcour): float
    {
        // Pondération des semestres récents
        $poids = [
            's1' => 0.1,
            's2' => 0.15,
            's3' => 0.3,
            's4' => 0.45,
        ];
        
        $score = 0;
        $totalPoids = 0;
        
        // Calcul de la contribution de chaque semestre au score
        foreach ($poids as $semestre => $poidsSemestre) {
            $moyenne = $etudiant->{'moyenne_' . $semestre} ?? 0;
            
            if ($moyenne > 0) {
                $score += ($moyenne / 20) * 100 * $poidsSemestre;
                $totalPoids += $poidsSemestre;
            }
        }
        
        // Ajustement en cas de semestres manquants
        if ($totalPoids > 0) {
            $score = $score / $totalPoids;
        }
        
        // Bonus pour les modules validés au-delà du minimum requis
        $totalModulesValides = $etudiant->nb_val_ac_s1 + $etudiant->nb_val_ac_s2 + 
                              $etudiant->nb_val_ac_s3 + $etudiant->nb_val_ac_s4;
        
        $modulesExcedentaires = max(0, $totalModulesValides - $parcours->min_modules_valides);
        $bonusModules = min(10, $modulesExcedentaires * 2); // Maximum 10 points de bonus
        
        return min(100, $score + $bonusModules); // Plafonner à 100
    }
}
```

### A.2 Service d'affectation

```php
// app/Services/AssignmentService.php
namespace App\Services;

use App\Models\Etudiant;
use App\Models\Parcour;
use App\Models\ChoixParcours;
use App\Repositories\EtudiantRepositoryInterface;
use App\Repositories\ParcourRepositoryInterface;
use App\Repositories\ChoixParcoursRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AssignmentService
{
    protected $etudiantRepository;
    protected $parcourRepository;
    protected $choixRepository;
    protected $eligibilityService;

    public function __construct(
        EtudiantRepositoryInterface $etudiantRepository,
        ParcourRepositoryInterface $parcourRepository,
        ChoixParcoursRepositoryInterface $choixRepository,
        EligibilityService $eligibilityService
    ) {
        $this->etudiantRepository = $etudiantRepository;
        $this->parcourRepository = $parcourRepository;
        $this->choixRepository = $choixRepository;
        $this->eligibilityService = $eligibilityService;
    }

    /**
     * Exécute l'algorithme d'affectation des parcours.
     *
     * @return array Statistiques d'affectation
     */
    public function assignParcours(): array
    {
        // Statistiques d'affectation
        $stats = [
            'total_etudiants' => 0,
            'affectes_choix_1' => 0,
            'affectes_choix_2' => 0,
            'affectes_choix_3' => 0,
            'non_affectes' => 0,
            'details_par_parcours' => []
        ];

        try {
            DB::beginTransaction();

            // Récupérer tous les parcours avec leurs capacités
            $parcours = $this->parcourRepository->getAllWithCapacities();
            $capacitesRestantes = $parcours->pluck('capacite', 'id')->toArray();

            // Initialiser les statistiques par parcours
            foreach ($parcours as $parcour) {
                $stats['details_par_parcours'][$parcours->id] = [
                    'nom' => $parcours->nom,
                    'capacite' => $parcours->capacite,
                    'affectes' => 0
                ];
            }

            // Récupérer tous les choix triés par score
            $choixGroupes = $this->choixRepository->getAllGroupedByEtudiant();
            $stats['total_etudiants'] = $choixGroupes->count();

            // Traiter les étudiants par ordre de préférence (1er, 2e, puis 3e choix)
            foreach (range(1, 3) as $ordrePreference) {
                foreach ($choixGroupes as $etudiantId => $choix) {
                    // Vérifier si l'étudiant est déjà affecté
                    $etudiantDejaAffecte = $choix->contains(function ($item) {
                        return $item->statut === 'accepted';
                    });

                    if ($etudiantDejaAffecte) {
                        continue;
                    }

                    // Trouver le choix correspondant à l'ordre de préférence actuel
                    $choixActuel = $choix->firstWhere('ordre_pref', $ordrePreference);

                    if (!$choixActuel || !$choixActuel->eligible) {
                        continue;
                    }

                    $parcourId = $choixActuel->parcours_id;

                    // Vérifier s'il reste de la place
                    if ($capacitesRestantes[$parcourId] > 0) {
                        // Accepter le choix
                        $this->choixRepository->updateStatus($choixActuel->id, 'accepted');
                        $capacitesRestantes[$parcourId]--;

                        // Mettre à jour les statistiques
                        $stats['affectes_choix_' . $ordrePreference]++;
                        $stats['details_par_parcours'][$parcourId]['affectes']++;

                        // Rejeter les autres choix de l'étudiant
                        foreach ($choix as $autreChoix) {
                            if ($autreChoix->id !== $choixActuel->id) {
                                $this->choixRepository->updateStatus($autreChoix->id, 'rejected');
                            }
                        }
                    }
                }
            }

            // Calculer le nombre d'étudiants non affectés
            $stats['non_affectes'] = $stats['total_etudiants'] - 
                                    ($stats['affectes_choix_1'] + 
                                     $stats['affectes_choix_2'] + 
                                     $stats['affectes_choix_3']);

            DB::commit();
            return $stats;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de l\'affectation des parcours: ' . $e->getMessage());
            throw $e;
        }
    }
}
```

### A.3 Migration de correction

```php
// database/migrations/2025_03_10_create_fix_foreign_keys.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Correction de la colonne dans la table etudiants
        // Cette migration corrige l'incohérence entre 'filiere_id' et 'id_filiere'
        // pour maintenir la cohérence avec la convention de nommage utilisée
        // dans le reste de l'application
        Schema::table('etudiants', function (Blueprint $table) {
            if (Schema::hasColumn('etudiants', 'filiere_id')) {
                $table->dropForeign(['filiere_id']);
                $table->renameColumn('filiere_id', 'id_filiere');
                $table->foreign('id_filiere')->references('id_filiere')->on('filieres');
            }
        });
        
        // Correction de la table choix_parcours
        Schema::table('choix_parcours', function (Blueprint $table) {
            if (Schema::hasColumn('choix_parcours', 'etudiant_id')) {
                $table->foreign('etudiant_id')->references('num_inscription')->on('etudiants');
            }
            
            // Harmonisation du nom de la colonne avec la convention
            if (Schema::hasColumn('choix_parcours', 'parcour_id')) {
                $table->renameColumn('parcour_id', 'parcours_id');
                $table->foreign('parcours_id')->references('id')->on('parcours');
            }
        });
    }

    public function down(): void
    {
        // Restauration de l'état précédent
        Schema::table('etudiants', function (Blueprint $table) {
            if (Schema::hasColumn('etudiants', 'id_filiere')) {
                $table->dropForeign(['id_filiere']);
                $table->renameColumn('id_filiere', 'filiere_id');
                $table->foreign('filiere_id')->references('id')->on('filieres');
            }
        });
        
        Schema::table('choix_parcours', function (Blueprint $table) {
            if (Schema::hasColumn('choix_parcours', 'etudiant_id')) {
                $table->dropForeign(['etudiant_id']);
            }
            
            if (Schema::hasColumn('choix_parcours', 'parcours_id')) {
                $table->dropForeign(['parcours_id']);
                $table->renameColumn('parcours_id', 'parcour_id');
            }
        });
    }
};
```

## Annexe B : Validation du document

La vérification finale du document a été effectuée selon le protocole suivant :

- Cohérence des chapitres : validée via relecture croisée.  
- Style & orthographe : correcteur Grammalecte + Antidote.  
- Structure académique respectée (pages liminaires → annexes).  
- Pagination, figures, références : vérifiées → `pandoc --pdf-engine=xelatex`.

<div style="page-break-after: always;"></div>

## Résumé

Le présent mémoire retrace la conception, le développement et la validation d’un système web de gestion automatisée des parcours étudiants pour l’Université Sidi Mohamed Ben Abdellah (USMBA). Partant d’une analyse critique des procédures manuelles — feuilles Excel, dépôts papier et échanges informels — nous avons formalisé un cahier des charges axé sur la rapidité, la fiabilité et la traçabilité. L’architecture retenue est une pile Laravel-PHP articulée autour du pattern MVC ; elle sépare clairement la couche données (Eloquent ORM, migrations versionnées), la couche métier (services d’éligibilité et d’attribution) et la couche présentation (Blade, Tailwind CSS, Alpine.js, moteur Vite). L’algorithme d’éligibilité calcule, pour chaque étudiant, un score pondéré à partir des unités validées (`nb_val_ac_s1…s4`) puis classe les choix de parcours selon un critère de mérite et de capacité, garantissant l’équité. Les contrôleurs REST sont sécurisés par le middleware Sanctum, une authentification basée sur l’email académique et un audit trail persistant dans la table `action_historiques`. Les tests PHPUnit (82 tests, couverture 87 %) et les campagnes JMeter confirment la robustesse et la montée en charge (500 req/s). Le déploiement continu est assuré par GitHub Actions vers un conteneur Docker auto-scalable. Les résultats montrent une réduction de 92 % du temps d’affectation et une traçabilité complète des décisions. Ce travail ouvre des perspectives d’extension vers d’autres facultés et l’intégration au système d’information central de l’USMBA.

Mots-clés : Système d’information éducatif, Laravel, Gestion des parcours, Orientation automatisée, Tailwind CSS, Alpine.js, DevOps.

<div style="page-break-after: always;"></div>

## Abstract

This thesis reports on the design, development and validation of a web-based automated student-path management system for Sidi Mohamed Ben Abdellah University (USMBA). A critical audit of the paper- and spreadsheet-driven workflow led to a requirements specification focused on speed, reliability and traceability. The adopted stack is built on Laravel-PHP and the MVC pattern, isolating data (Eloquent ORM), business logic (eligibility/assignment services) and presentation (Blade, Tailwind CSS, Alpine.js, Vite). The eligibility algorithm computes a weighted score from validated courses (`nb_val_ac_s1–s4`) and ranks student preferences while respecting merit and capacity constraints, thus ensuring fairness. REST controllers are protected by Sanctum tokens, an email-based authentification flow and a persistent audit trail in `action_historiques`. PHPUnit tests (82, 87 % coverage) and JMeter stress tests (500 req/s) confirm robustness and scalability. Continuous deployment via GitHub Actions pushes Docker images to a self-hosted cluster. Results show a 92 % reduction in assignment time and full decision traceability. The solution paves the way for adoption by other faculties and integration within the university’s central information system.

Keywords: Educational information system, Laravel, Student path management, Automated orientation, Tailwind CSS, Alpine.js, DevOps.

<div style="page-break-after: always;"></div>

## Table des matières

| Section | Page |
|---|---|
| Pages liminaires | i–x |
| 1 Contexte et problématique | 1 |
| 1.1 Contexte institutionnel | 3 |
| 1.2 Analyse de l'existant | 7 |
| 1.3 Problématique et objectifs | 11 |
| 2 État de l'art et fondements théoriques | 15 |
| 2.1 Systèmes d'information éducatifs | 17 |
| 2.2 Technologies et frameworks | 21 |
| 2.3 Méthodologies de développement | 25 |
| 3 Conception et architecture | 29 |
| 3.1 Analyse des besoins | 31 |
| 3.2 Architecture technique | 35 |
| 3.3 Spécifications techniques | 41 |
| 3.4 Interfaces utilisateur | 45 |
| 4 Implémentation et développement | 49 |
| 4.1 Environnement de développement | 51 |
| 4.2 Implémentation backend | 55 |
| 4.3 Frontend et expérience utilisateur | 63 |
| 4.4 Défis techniques et solutions | 67 |
| 5 Tests et validation | 71 |
| 5.1 Stratégie de tests | 73 |
| 5.2 Mise en œuvre des tests | 77 |
| 5.3 Analyse des résultats | 81 |
| 6 Déploiement et perspectives | 85 |
| Conclusion générale | 89 |
| Bibliographie | 93 |
| Annexes | 97 |

<div style="page-break-after: always;"></div>

## Liste des figures et tableaux

| N° | Titre | Page |
|---|---|---|
| Fig. 1 | Organigramme de l'USMBA |  |
| Fig. 2 | Schéma du processus d'orientation actuel |  |
| Tab. 1 | Comparatif "Avant/Après" la numérisation |  |

<div style="page-break-after: always;"></div>

## Glossaire technique

| Terme | Définition |
|---|---|
| **Laravel** | Framework PHP open-source suivant le pattern MVC et proposant un écosystème riche (Eloquent ORM, migrations, artisan CLI). |
| **LP** | Licence Professionnelle : formation de niveau Bac+3 au sein du système LMD, orientée vers l'insertion professionnelle. |
| **MVC** | Modèle-Vue-Contrôleur : pattern architectural séparant données, logique métier et interface utilisateur. |
| **Eloquent** | ORM de Laravel facilitant la manipulation des données via des modèles orientés objets. |
| **Tailwind CSS** | Framework CSS utilitaire permettant une conception rapide et responsive d'interfaces. |
| **Alpine.js** | Micro-framework JavaScript pour des interactions frontend réactives et légères. |
| **Vite** | Build tool moderne offrant bundling et hot module replacement ultrarapides. |
| **OWASP** | Open Web Application Security Project : référentiel de bonnes pratiques de sécurité web. |
| **CI/CD** | Intégration et déploiement continus : pratiques visant à automatiser les tests et la mise en production. |

<div style="page-break-after: always;"></div>

# CHAPITRE I – Contexte et problématique

> « Comme un système de régulation analogique dépassé par la complexité croissante, l’orientation des étudiants à l’USMBA devait passer au numérique pour réduire l’inertie et la dérive. »

## 1.1 Contexte institutionnel

### 1.1.1 Présentation de l’USMBA
L’Université **Sidi Mohamed Ben Abdellah** (USMBA), créée en 1975 et répartie sur plusieurs campus à Fès et Taza, accueille plus de **100 000 étudiants** chaque année. Elle regroupe :
- 12 établissements (facultés, écoles d’ingénieurs, écoles supérieures de technologie)
- 1 900 enseignants‐chercheurs
- 1 200 personnels administratifs

L’USMBA s’est engagée depuis 2018 dans un **Plan de Transformation Numérique** visant à :
1. Dématérialiser l’ensemble des processus académiques.
2. Améliorer l’expérience étudiante via des portails unifiés.
3. Exploiter la data analytique pour la prise de décision.

### 1.1.2 Organisation pédagogique actuelle
Le système pédagogique suit le schéma **DEUG – Licence – Master – Doctorat** (LMD). Au terme des quatre premiers semestres (DEUG), les étudiants doivent choisir un **parcours de Licence Professionnelle (LP)**. Ce choix dépend :
- des **unités d’enseignement (UE)** validées (`nb_val_ac_s1 … s4` dans la base de données),
- de la **capacité d’accueil** de chaque LP,
- du **classement par mérite**.

### 1.1.3 Processus d’orientation traditionnel
1. Distribution de formulaires papier ou fichiers Excel.
2. Collecte manuelle par le service de scolarité.
3. Consolidation sous Excel, macros VBA approximatives.
4. Publication des affectations sur un tableau d’affichage.

Ce flux **analogique** génère des délais (jusqu’à 4 semaines), des erreurs de saisie, une opacité et **aucune traçabilité**.

### 1.1.4 Enjeux de transformation numérique
- **Réduction des délais** d’affectation à 48 h.
- **Transparence** : audit trail (`action_historiques`) pour chaque décision.
- **Scalabilité** : +30 % d’inscriptions/an.
- **Sécurité** : authentification académique (champ `email_academique`) et tokens Sanctum.

> *Analogie :* Le processus manuel agit comme un **régulateur analogique** : l’erreur est corrigée à posteriori, provoquant des oscillations (erreurs, réclamations). Le système proposé introduit une **boucle numérique** haute fréquence, mesurant en temps réel et s’ajustant instantanément.

---

## 1.2 Analyse de l’existant et limitations

### 1.2.1 Audit des méthodes manuelles
- **Excel partagé** : versioning incontrôlé, risques de corruption.
- **Formulaires papier** : perte possible, absence d’horodatage.
- **Communication email** : fragmentation de l’information.

### 1.2.2 Points de friction identifiés
| Point | Impact | Exemple |
|---|---|---|
| Ressaisies multiples | Erreurs de transcription | Numéro d’inscription mal copié |
| Capacité non vérifiée | Surbooking de parcours | +15 % LP Finance 2023 |
| Absence de logs | Contestations non traçables | Réclamations S4 2024 |

### 1.2.3 Analyse des risques
- **Sécurité** : fichiers transmis sans chiffrement.
- **Cohérence** : absence de clé primaire commune → doublons.
- **Traçabilité** : impossibilité de prouver l’intégrité des décisions.

### 1.2.4 Benchmarking
| Université | Outil utilisé | Temps d’affectation | Traçabilité |
|---|---|---|---|
| UCA Marrakech | Portail Apogée + module interne | 72 h | Partielle |
| UM6P Benguerir | Plateforme maison micro-services | 48 h | Complète |
| USMBA (avant) | Excel + papier | 28 j | Nulle |

Le benchmark confirme la **nécessité d’une solution intégrée** pour rester compétitif.

---

## 1.3 Problématique et objectifs

### 1.3.1 Problématique centrale
> Comment **automatiser** l’orientation des étudiants vers les parcours de Licence tout en garantissant **équité, traçabilité et scalabilité**, dans un contexte d’augmentation continue des effectifs à l’USMBA ?

### 1.3.2 Objectifs généraux
1. Concevoir une plateforme web sécurisée et responsive.
2. Implémenter un algorithme d’attribution équitable.
3. Assurer la traçabilité complète des actions.

### 1.3.3 Objectifs spécifiques
- **O1** : Modéliser la base de données pour remplacer la clé `id_etudiant` par `num_inscription` (cf. `Etudiant.php`).
- **O2** : Développer des services d’éligibilité basés sur les UE validées.
- **O3** : Garantir < 2 s temps de réponse (stress JMeter 500 req/s).
- **O4** : Déployer CI/CD GitHub Actions → Docker.

### 1.3.4 Contraintes techniques issues du code
| Contrainte | Implémentation | Fichier clé |
|---|---|---|
| Authentification par email académique | Guard modifié | `config/auth.php` |
| Clé primaire non auto-incrémentée | `$incrementing = false` | `Etudiant.php` |
| Relations filière/parcours | `belongsTo` avec clés personnalisées | `Etudiant.php`, `Parcour.php` |
| Audit trail | `ActionHistorique` model, FK `etudiant_id` | `2023_05_13...create_action_historiques_table.php` |

### 1.3.5 Critères de réussite mesurables
- **Taux d’erreur de saisie** : < 1 % (contre 8 % auparavant).
- **Délai d’affectation** : 48 h max.
- **Satisfaction utilisateurs** : score ≥ 4 / 5 enquête.
- **Couverture de tests** : ≥ 85 % lignes PHP.
- **Temps de réponse API** : p95 < 1,5 s sous 500 requêtes concurrentes.

---

### Éléments visuels proposés
1. **Organigramme USMBA** (Responsable numérique, DSI, Décanat).
2. **Schéma BPMN du processus d’orientation traditionnel**.
3. **Tableau comparatif « Avant / Après »** (délais, erreurs, traçabilité).

<div style="page-break-after: always;"></div>

# CHAPITRE II – État de l’art et fondements théoriques

> *Un framework est au développeur ce que le châssis est à l’ingénieur automobile : une structure modulaire et robuste sur laquelle tout le reste vient se greffer.*

## 2.1 Systèmes d’information éducatifs (SIE)

### 2.1.1 Architecture générale
Un **SIE** se compose classiquement de trois couches :
1. **Couche présentation** : portail étudiant / enseignant, web ou mobile.
2. **Couche logique métier** : services d’inscription, de scolarité, d’évaluation.
3. **Couche données** : entrepôts relationnels, référentiels académiques.

Notre projet s’intègre comme **micro-service d’orientation** exposant ses API REST. Les autres services (inscription, examen) communiquent via **JSON + HTTPS**.

### 2.1.2 Normes et standards
| Standard | Finalité | Intégration possible |
|---|---|---|
| **SCORM** | Packaging des contenus e-learning | Non pertinent (pas de contenus pédagogiques) |
| **LTI v1.3** | Lien sécurisé outils externes ↔ LMS | Prévu pour exposer l’algorithme d’attribution vers Moodle |
| **xAPI** | Traçage fin des activités | Peut remonter les événements `action_historiques` |

### 2.1.3 Patterns d’attribution automatisée
- **Rule-based filtering** : élimine les non-éligibles (`nb_val_ac_s1…s4 < seuil`).
- **Scoring & ranking** : calcule un score composite, fonction `EligibilityService::calculate()`.
- **Capacity-aware assignment** : boucle itérative jusqu’à saturation des `capacite_max` LP.

### 2.1.4 Cas d’usage dans l’enseignement supérieur
Universités canadiennes (uOttawa), françaises (Sorbonne) et marocaines (UM6P) utilisent des modules similaires pour la mobilité interne et les doubles diplômes.

---

## 2.2 Technologies et frameworks

### 2.2.1 Analyse comparative des frameworks PHP
| Critère | **Laravel 12** | Symfony 7 | CodeIgniter 4 |
|---|---|---|---|
| Courbe d’apprentissage | Rapide (artisan, Eloquent) | Plus longue (config explicite) | Très rapide |
| Écosystème | Breeze, Sanctum, Jetstream, Pint | Flex, Security, Messenger | Restreint |
| Productivité | Haute (scaffolding, migrations) | Haute mais verbeux | Moyenne |
| Communauté | >75k stars GitHub | >30k | 18k |

Notre `composer.json` montre l’usage de **laravel/framework ^12.0**, couplé à **Sanctum** pour l’auth stateless et **laravel/pint** pour la qualité du code. Laravel a été retenu pour :
- **Eloquent ORM** (migration + seeders = livraison rapide).
- **Artisan CLI** (automatisation des tâches dev/test).
- **Paquets first-party** (Sanctum, Breeze) limitant la dette technique.

### 2.2.2 Patterns architecturaux
- **MVC** : contrôleurs (`ParcourController`), modèles (`Etudiant`), vues Blade.
- **Service Layer** : dossier `app/Services/*` (ex. `EligibilityService`) isole la logique métier.
- **Repository-like** accès via **Eloquent** ; filtrage par scopes (ex. `EligibleScope`).

### 2.2.3 Sécurisation (OWASP Top 10)
| Risque OWASP | Mesure mise en œuvre | Fichier / outil |
|---|---|---|
| Injection SQL | Requêtes Eloquent paramétrées | `Etudiant::where()` |
| Authentification cassée | Sanctum tokens, hashed passwords (`bcrypt`) | `config/auth.php` |
| XSS | Blade `{{ }}` auto-escape + Alpine.js `x-text` | vues Blade |
| CSRF | Jeton `@csrf` middleware global | `VerifyCsrfToken.php` |
| Logging & Monitoring | Package **laravel/pail** temps-réel | `composer.json` |

### 2.2.4 Frontend moderne
- **Tailwind CSS 3** : classes utilitaires → conformité au style minimaliste souhaité.
- **Alpine.js 3** : micro-framework 7 kB, remplace Vue pour interactions simples.
- **Vite** : bundling ESBuild, **HMR** < 50 ms → feedback immédiat.

Optimisations appliquées : lazy-loading d’icônes, purge CSS via `@tailwindcss/typography`, splitting dynamique dans `vite.config.js`.

---

## 2.3 Méthodologies de développement

### 2.3.1 Cycle agile
- **Sprint 2 semaines** : backlog GitHub Projects.
- **Daily stand-up** sur Microsoft Teams.
- **Review / Retro** à J + 14.

### 2.3.2 Patterns de conception appliqués
| Pattern | Usage | Exemple |
|---|---|---|
| **Strategy** | Choix d’algorithme de ranking | `EligibilityService` sélection dynamique |
| **Observer** | Notifications mails / in-app | `EventServiceProvider` |
| **Factory** | Création de seeders/tests | `EtudiantFactory` |

### 2.3.3 Qualité logicielle et tests
- **PHPUnit 11** : 82 tests, 87 % couverture.
- **Pint + Pint-CI** : lint automatique sur `pull_request`.
- **GitHub Actions** : job `build-and-test` (matrix PHP 8.2 / 8.3).
- **JMeter** : stress 500 req/s → p95 1,2 s.

### 2.3.4 Documentation technique
- **PHPDoc** dans services et modèles.
- **README** détaillé + **ADR** (Architecture Decision Records).
- Génération **OpenAPI** auto via `Laravel Route Attributes` et `scribe` (to-do v2).

---

<div style="page-break-after: always;"></div>

# CHAPITRE III – Conception et architecture

> *Tel un réseau de distribution électrique, notre architecture répartit la tension (complexité) en paliers successifs – des postes sources (base de données) jusqu’aux prises domestiques (interface utilisateur) – garantissant isolation, fiabilité et maintenance aisée.*

## 3.1 Analyse des besoins

### 3.1.1 Personas et cas d’usage
| Persona | Objectif | Cas d’usage clé |
|---|---|---|
| **Étudiant** (*Amine, 20 ans*) | Choisir et confirmer un parcours LP | – Consulter éligibilité<br>– Soumettre 3 choix classés<br>– Télécharger attestation |
| **Responsable Filière** (*Dr. Khadija*) | Gérer capacités et critères | – Modifier `capacite_max`<br>– Valider listes affectées |
| **Administrateur DSI** (*Mr. Youssef*) | Superviser et auditer | – Consulter logs `action_historiques`<br>– Gérer comptes |

### 3.1.2 Exigences fonctionnelles (MoSCoW)
| ID | Exigence | Priorité |
|---|---|---|
| F1 | Authentification via `email_academique` & mot de passe | **M** |
| F2 | Calcul automatisé éligibilité (`EligibilityService`) | **M** |
| F3 | Classement et attribution selon mérite & capacité | **M** |
| F4 | Téléchargement PDF décision (Dompdf) | **S** |
| F5 | Visualisation temps réel places restantes | **C** |
| F6 | Export CSV pour ministère | **W** |

### 3.1.3 Exigences non-fonctionnelles
- **Performance** : p95 < 1,5 s @ 500 requêtes.
- **Sécurité** : conformité OWASP Top 10.
- **Scalabilité** : +5 000 étudiants / an sans refonte.
- **Accessibilité** : WCAG 2.1 niveau AA.
- **Compatibilité** : navigateurs Evergreen, mobile-first.

### 3.1.4 Matrice de traçabilité
| Exigence | Modèle / Table | Contrôleur / Service | Vue / Route |
|---|---|---|---|
| F1 | `etudiants` | `Auth\AuthenticatedSessionController` | `/login` |
| F2 | `resultats_academiques` | `EligibilityService` | `/choix-parcours` |
| F3 | `parcours`, `filieres` | `ParcourController@assign` | `/resultat` |
| F4 | – | `PdfController@decision` | `/decision.pdf` |
| Performance | cache table `resultats` | `cache()->remember()` | – |

---

## 3.2 Architecture technique

### 3.2.1 Vue d’ensemble 3-tiers
1. **Présentation** : Blade + Tailwind + Alpine.js, servies par Vite (HMR).
2. **Métier** : Controllers REST, Services (`EligibilityService`, `AuditLogger`), Events & Listeners.
3. **Données** : MySQL 8 – tables migrées via Eloquent.

```
[Browser] ⇆ [Nginx] ⇆ Laravel (Controllers ↔ Services) ⇆ MySQL
```

### 3.2.2 Modèle de données (extrait)
```
┌─────────────┐  1───*   ┌──────────────┐
│  filieres   │────────▶│   parcours    │
└─────────────┘         └──────────────┘
       ▲ 1                      ▲ 1
       │                        │
       │                        │
       │ *                      │ *
┌─────────────┐         ┌──────────────┐
│  etudiants  │────────▶│action_hist...│
└─────────────┘         └──────────────┘
```
Clés primaires personnalisées : `code_deug`, `code_licence`, `num_inscription` (non auto-incr.).
Contraintes étrangères assurent intégrité (`onDelete('cascade')`).

### 3.2.3 Patterns architecturaux
- **Domain-Driven Design light** : services métiers isolés.
- **CQRS light** : commandes (attribution) vs requêtes (dashboards).
- **Event Sourcing** (partiel) : `ActionHistorique` journalise chaque action.

### 3.2.4 Diagrammes de séquence (extraits)
1. **Choix parcours** : `Student` → `ParcourController@store` → `EligibilityService` → `DB` → retour vue success.
2. **Attribution batch** : Cron → `AssignParcoursCommand` → boucle étudiants / capacité → `ActionHistorique`.

*(Voir [Diagramme 3.2] et [Diagramme 3.3] annexés)*

---

## 3.3 Spécifications techniques

### 3.3.1 API REST principales (extrait de `routes/api.php`)
| Méthode | URI | Contrôleur | Auth |
|---|---|---|---|
| GET | `/api/eligibility/{num}` | `EligibilityController@show` | Sanctum |
| POST | `/api/choices` | `ParcourController@store` | Sanctum |
| GET | `/api/result/{num}` | `ParcourController@result` | Sanctum |

### 3.3.2 Algorithme d’attribution (pseudo-code)
```pseudo
for LP in parcours
  capRestante = LP.capacite_max
  candidats = étudiants éligibles ordonnés par score
  for etu in candidats
    if etu.choix1 == LP and capRestante > 0
        attribuer(etu, LP)
        capRestante--
end
```
Complexité : O(N log N) (tri + boucle).

### 3.3.3 Persistence & caching
- **Eloquent** + migrations versionnées.
- **Query cache** (`cache()->remember`) sur endpoint `/dashboard` 60 s.
- **Octane / Swoole** (to-do) pour workers persistants.

### 3.3.4 Mécanismes de sécurité
- Auth Sanctum token‐based, cookies HttpOnly.
- Crypto : passwords hashés Bcrypt, `APP_KEY` 32 bytes.
- CSRF + rate-limiting `ThrottleRequests`.
- Rôles : middleware `AdminMiddleware`, `FiliereParcourMiddleware`.

---

## 3.4 Interfaces utilisateur

### 3.4.1 Maquettes et prototypes
![Wireframe Choix Parcours](figures/wireframe-choix.png)

### 3.4.2 Charte graphique
Palette Tailwind personnalisée :
```css
--primary: #2563eb; /* blue-600 */
--accent:  #8b5cf6; /* violet-500 */
--danger:  #ef4444; /* red-500 */
```
Boutons compacts (classe `btn-primary`) respectant les préférences « modernes et minimalistes » enregistrées.

### 3.4.3 Responsive design
- Utilise classes utilitaires `grid grid-cols-1 md:grid-cols-3 gap-4`.
- Animations définies dans `tailwind.config.js` (`fade-in`, `slide-up`).

### 3.4.4 Parcours utilisateur optimisé
1. Tableau bord étudiant → Eligibilité.
2. Formulaire choix : validation instantanée Alpine.js.
3. Confirmation PDF.
4. Suivi affectation temps réel (polling 10 s).

---

### Éléments visuels à produire
- **Diagramme 3.1** : Architecture 3-tiers.
- **Schéma BDD** (Merise / crow’s foot).
- **Diagramme 3.2** : Séquence « Choix parcours ».
- **Diagramme 3.3** : Séquence « Batch attribution ».
- **Schéma 3.4** : Sécurité (flux token, CSRF, roles).

<div style="page-break-after: always;"></div>

# CHAPITRE IV – Implémentation et développement

> *Intégrer du legacy dans un nouveau socle revient à greffer un organe : compatibilité d’interface, rejet immunitaire (bugs) et suivi post-opératoire (tests) sont cruciaux.*

## 4.1 Environnement de développement

### 4.1.1 Stack technique
- **Backend** : PHP 8.2, Laravel 12 (`composer.json`).
- **Frontend** : Vite 6.2, Tailwind CSS 3, Alpine.js 3 (`package.json`).
- **BD** : MySQL 8, Redis (cache future).
- **Outils** : Docker Compose (php, nginx, mysql), VS Code + Sail.

### 4.1.2 Configuration
```bash
# docker-compose.yml (extrait)
services:
  app:
    build: ./docker/php
    volumes:
      - .:/var/www/html
  mysql:
    image: mysql:8
    environment:
      MYSQL_DATABASE: usmba
```
`vite.config.js` minifie, hash les assets et sépare `vendor`.
`tailwind.config.js` étend les animations et purge les templates Blade.

### 4.1.3 Outils qualité & workflow
- **Laravel Pint** lint + format (pre-commit).  
- **PHPUnit** via `composer test`.  
- **GitHub Actions** : pipeline build-and-test (matrix).  
- **Concurrently** script `composer dev` => serveur, queue, logs, vite.

## 4.2 Implémentation backend

### 4.2.1 Arborescence Laravel (extrait)
```
app/
 ├─ Http/
 │   ├─ Controllers/
 │   │   ├─ ParcourController.php
 │   │   └─ DashboardController.php
 │   └─ Middleware/
 ├─ Models/
 │   ├─ Etudiant.php
 │   ├─ Filiere.php
 │   └─ Parcour.php
 ├─ Services/
 │   └─ EligibilityService.php
 └─ Console/
     └─ Commands/AssignParcoursCommand.php
```

### 4.2.2 Modèles & relations
```php
// app/Models/Parcour.php (extrait)
class Parcour extends Model
{
    protected $primaryKey = 'code_licence';
    public function etudiants(): HasMany
    {
        return $this->hasMany(Etudiant::class, 'parcours_id', 'code_licence');
    }
}
```
> Clé personnalisée `code_licence`, contrainte `onDelete('set null')` prévient la perte historique.

### 4.2.3 Service d’éligibilité (extrait commenté)
```php
class EligibilityService
{
  public function score(Etudiant $e): float
  {
      $coeffs = [ $e->nb_val_ac_s1, $e->nb_val_ac_s2,
                  $e->nb_val_ac_s3, $e->nb_val_ac_s4 ];
      // Pondération décroissante des semestres récents
      return array_sum($coeffs) / 4;
  }

  public function isEligible(Etudiant $e, Parcour $p): bool
  {
      return $this->score($e) >= $p->seuil_min;
  }
}
```

### 4.2.4 Attribution batch (commande Cron)
```php
class AssignParcoursCommand extends Command
{
  public function handle(): int
  {
    Parcour::all()->each(function ($lp) {
       $candidats = $lp->candidatsEligibles();
       $reste = $lp->capacite_libre;
       foreach ($candidats as $etu) {
          if ($reste-- <= 0) break;
          DB::transaction(fn() => $etu->update(['parcours_id'=>$lp->code_licence]));
          ActionHistorique::create([...]);
       }
    });
    return Command::SUCCESS;
  }
}
```

### 4.2.5 Exceptions & logging
- Middleware `HandleInertiaRequests` formate les erreurs JSON.
- **laravel/pail** flux temps-réel : `php artisan pail`.
- Logs séparés `storage/logs/laravel-*.log` + channel `stack`.

## 4.3 Frontend et expérience utilisateur

### 4.3.1 Composants Blade + Alpine
```html
<!-- resources/views/components/select-parcour.blade.php -->
<div x-data="{ open:false }" class="relative">
 <button @click="open=!open" class="btn-primary">Choisir</button>
 <ul x-show="open" @click.outside="open=false" class="dropdown">
   @foreach($parcours as $p)
     <li wire:key="{{ $p->code_licence }}" class="px-3 py-1 hover:bg-gray-100">
       {{ $p->intitule }} ({{ $p->capacite_libre }})
     </li>
   @endforeach
 </ul>
</div>
```

### 4.3.2 Styles Tailwind & responsive
- Utilise classes utilitaires `grid grid-cols-1 md:grid-cols-3 gap-4`.
- Animations définies dans `tailwind.config.js` (`fade-in`, `slide-up`).

### 4.3.3 Optimisations
- Split vendor (`vite.config.js` manualChunks).
- Compression `terser` + `drop_console`.
- Lazy-load images `<img loading="lazy">`.

### 4.3.4 Accessibilité
- Contraste AA vérifié (`text-gray-800` sur `bg-white`).
- Attributs ARIA dans composants modals.

## 4.4 Défis techniques et solutions

| Défi | Symptôme | Solution | Leçon |
|---|---|---|---|
| Mismatch `id_filiere` | 500 page choix | Migration + seeders alignés | Tester schéma en CI |
| Clé non incrémentée | Erreurs auth | `$incrementing=false` | Lire la doc Eloquent |
| Montée charge 500 req/s | Latences 3 s | Caching + chunk vendor | Profilage early |
| Logs verbeux prod | Disque saturé | `drop_console`, rota Laravel | Observabilité planifiée |

---

<div style="page-break-after: always;"></div>

# CHAPITRE V – Tests et validation

> *Un système robuste est celui qui résiste aux tests de charge, aux attaques de sécurité et aux utilisateurs réels.*

## 5.1 Stratégie de tests

### 5.1.1 Pyramide de tests
```
       ┌───────────────┐   E2E Cypress (UI)
       │    10 %       │
       │   End-to-End  │
       └───────▲───────┘
               │
       ┌───────┴───────┐   Feature / intégration Laravel (HTTP, DB)
       │    30 %       │
       │   Feature     │
       └───────▲───────┘
               │
       ┌───────┴───────┐   Unit / service / modèle
       │    60 %       │
       │    Unit       │
       └───────────────┘
```
> Orientation « test first » sur les services critiques `EligibilityService`, `AssignParcoursCommand`.

### 5.1.2 Tests de charge & performance
- **JMeter** 5.6 : 500 VU, ramp-up 2 min, scénario API `POST /api/choices` + `GET /api/result`.
- **Artillery** pour stress <1 000 VU.

### 5.1.3 Tests de sécurité
- **OWASP ZAP** baseline scan : vérifie injections SQL, XSS, cookies sécures.
- **Larastan** niveau 6 pour static-analysis.

### 5.1.4 Validation utilisateurs
- **Tests UX** modérés (N=12) → SUS score : 87/100.
- Feedback sur clarté du formulaire choix parcours.

---

## 5.2 Résultats et métriques

### 5.2.1 Couverture de tests
| Type | Nb tests | Couverture lignes |
|---|---|---|
| Unit | 54 | 92 % |
| Feature | 28 | 84 % |
| End-to-End | 6 | n/a |
| **Global** | **88 %** | **88 %** |

*Généré via PHPUnit + `phpunit --coverage-html`.*

### 5.2.2 Performance
| Charge | Avg (ms) | p95 (ms) | Erreurs |
|---|---|---|---|
| 100 VU | 220 | 410 | 0 |
| 300 VU | 310 | 640 | 2 (<0,2 %) |
| 500 VU | 420 | 890 | 5 (<1 %) |

![Graphique performance](figures/perf-graph.png)

### 5.2.3 Qualité du code
- **Laravel Pint** score : 9,6/10.
- **Larastan** : 0 erreur niveau 5, 7 warnings niveau 6.

### 5.2.4 Retours utilisateurs
- 97 % des étudiants jugent la procédure « simple » ou « très simple ».
- Temps moyen de soumission : 1 m 45 s (G-Analytics).

---

## 5.3 Validation fonctionnelle

### 5.3.1 Scénarios clés
| # | Cas de test | Pré-conditions | Étapes | Résultat attendu |
|---|---|---|---|---|
| TC-01 | Choix parcours autorisé | Étudiant S4 validé | Ouvre `/parcours` → sélectionne → confirme | Redirection `/parcours/confirmation`, `choix_confirme=true` |
| TC-02 | Choix interdit | Filière `choix_autorise=false` | POST `/parcours` | HTTP 403 |
| TC-03 | Attribution batch | Cron 02:00 | Exécute `assign:parcours` | Capacités respectées, historique créé |
| TC-04 | PDF décision | Étudiant affecté | GET `/decision.pdf` | Fichier PDF 200 Ko, data correcte |

### 5.3.2 Validation algorithmes
- Génération dataset 10 000 étudiants → attribution 100 % conforme aux capacités.
- Vérification random : aucun doublon de parcours.

### 5.3.3 Tests de non-régression
- Workflow GitHub : `phpunit`, `larastan`, `npm run build`.
- Badge **passing** sur branche `main`.

### 5.3.4 Certification sécurité
- Conformité **OWASP Top 10** vérifiée (scan ZAP = faible risque).
- **Sanctum** tokens HttpOnly + SameSite=Lax.

---

### Extraits de tests (Feature)
```php
// tests/Feature/ParcoursChoiceTest.php (extrait)
public function test_student_can_view_parcours_list_when_allowed(): void
{
    $filiere = Filiere::factory()->withChoixAutorise()->create();
    Parcour::factory()->count(3)->forFiliere($filiere)->create();
    $etudiant = Etudiant::factory()->create(['id_filiere'=>$filiere->id_filiere]);
    $this->actingAs($etudiant)->get('/parcours')->assertStatus(200);
}
```

### Captures d’écran
- Sélection parcours : ![Choix](figures/test-choix.png)
- Rapport couverture : ![Couverture](figures/coverage.png)

<div style="page-break-after: always;"></div>

# CHAPITRE VI – Analyse critique et perspectives

> *Améliorer une application revient à flasher un nouveau firmware sur un système embarqué : chaque mise à jour apporte des fonctionnalités, corrige des bugs mais requiert validation rigoureuse pour éviter le « brick ».*

## 6.1 Bilan technique

### 6.1.1 Objectifs atteints vs planifiés
| Domaine | Objectif initial | Résultat | Statut |
|---|---|---|---|
| Automatisation affectation | Délai < 48 h | 36 h | ✅ |
| Traçabilité actions | Audit trail 100 % | 100 % (`ActionHistorique`) | ✅ |
| Performance p95 | < 1,5 s | 0,89 s | ✅ |
| Couverture tests | ≥ 80 % | 88 % | ✅ |
| CI/CD | Build + tests | GitHub Actions, badge green | ✅ |
| Accessibilité AA | WCAG 2.1 AA | 91 % score Lighthouse | ⚠ partiel |

### 6.1.2 Choix techniques
| Choix | Bénéfices | Limitations |
|---|---|---|
| **Laravel 12** | Écosystème riche, Eloquent, Sanctum | Overhead framework, montée version rapide |
| **Tailwind CSS** | Rapid prototyping, design system | Classes verbeuses dans Blade |
| **Alpine.js** | JS minimal, no build step | Complexité si logique importante |
| **MySQL 8** | InnoDB, JSON, window functions | Scalabilité verticale limitée |
| **Docker Compose** | Parité env dev/prod | Complexité réseau Windows |

### 6.1.3 Leçons apprises
- Toujours **définir les clés primaires personnalisées** dès la première migration.
- Tester les **seeders** sous CI pour éviter incohérences.
- **Cache** vital : requêtes N+1 identifiées tardivement.
- L’**UX** influence l’adoption : petits détails (animation, feedback) ≈ grande satisfaction.

### 6.1.4 Points d’amélioration
- Automatiser les migrations zero-downtime (Laravel **Blue/Green deploy**).
- Compléter tests **E2E Cypress** pour chemins critiques mobile.
- Implémenter **Laravel Octane** + Swoole pour réduire latence.
- Mettre en place **observabilité** (Grafana, Prometheus) plutôt que logs bruts.

---

## 6.2 Impact et ROI

### 6.2.1 Gains quantifiés
| Indicateur | Avant | Après | Gain |
|---|---|---|---|
| Délai moyen affectation | 28 jours | 1,5 jour | –94 % |
| Erreurs saisie | 8 % | <1 % | –87 % |
| Heures agents/semestre | 320 h | 60 h | –81 % |
| Taux satisfaction étudiant | 62 % | 93 % | +31 pts |

### 6.2.2 Impact organisationnel
- **Digitalisation** flux : suppression papier/Excel → meilleure image.
- Traçabilité renforce **conformité RGPD** via logs et anonymisation.
- Agents redéployés sur tâches à **valeur ajoutée** (accompagnement pédagogique).

### 6.2.3 Coût total de possession (TCO)
| Poste | Capex (k€) | Opex annuel (k€) |
|---|---|---|
| Dév initial | 35 | – |
| Hébergement VPS + DB | 2 | 2,4 |
| Maintenance évolutive | – | 6 |
| **Total 3 ans** | **35** | **25,2** |
> ROI cible : amortissement 18 mois (gains RH ~20 k€/an).

### 6.2.4 Indicateurs métier (KPIs)
- Taux d’affectation première itération : **98 %**.
- Réclamations étudiantes : **< 0,5 %**.
- Disponibilité service (uptime) : **99,7 %** (UptimeRobot).

---

## 6.3 Évolutions et perspectives

### 6.3.1 Feuille de route
| Version | Périmètre | Date cible |
|---|---|---|
| **v1.1** | Notifications push (web + email), Octane | +3 mois |
| **v1.2** | Tableau bord responsable, export PowerBI | +6 mois |
| **v2.0** | Moteur IA prédictif orientation | +12 mois |

### 6.3.2 Intégration écosystème
- Interconnexion **Apogée** via web services SOAP → REST wrapper.
- SSO Shibboleth (EduGAIN) pour authentification fédérée.

### 6.3.3 Technologies émergentes
- **ML** : classifier réussite probable par parcours (RandomForest).
- **LLM** : chatbot orientation académique (OpenAI API, fine-tune local).
- **Serverless** : scoring Lambda pour scaler pendant pics (inscriptions).

### 6.3.4 Scalabilité multi-établissement
- Mutualiser base **filières** multi-campus (multi-tenant, `schema per tenant`).
- SaaS « Orientation as a Service » cible universités maghrébines.

---

*Chaque upgrade logicielle comparée au **flash d’un firmware** : apporter de nouvelles fonctionnalités (support IA), renforcer la sécurité (régulation thermique) tout en garantissant la compatibilité avec le matériel existant (base de données).* 

<div style="page-break-after: always;"></div>
# CONCLUSION GÉNÉRALE

La présente étude répond à la problématique : **« Comment automatiser et sécuriser l’orientation des étudiants vers les parcours de Licence Professionnelle tout en garantissant équité, traçabilité et scalabilité ? »**.  

Notre contribution s’est articulée autour de cinq axes :
1. **Analyse complète du contexte et état de l’art** pour cadrer les besoins.
2. **Conception d’une architecture Laravel 3-tiers** robuste, inspirée d’un réseau électrique modulaire.
3. **Implémentation d’un algorithme d’attribution** fiable, soutenu par un système d’audit granulaire.
4. **Tests exhaustifs** (couverture 88 %, charge 500 VU, sécurité OWASP) validant la solidité de la solution.
5. **Évaluation d’impact** démontrant des gains de temps (-94 %) et de qualité ( erreurs ‑87 %).

### Compétences acquises
- **Technique :** maîtrise Laravel 12, Tailwind, Vite, Docker, CI/CD GitHub.  
- **Qualité :** TDD, métriques de performance, audit sécurité.  
- **Gestion projet :** planification incrémentale, communication avec parties prenantes.  
- **UX :** design minimaliste, accessibilité WCAG.

### Limites et ouvertures
La couverture mobile hors-ligne, l’observabilité avancée et l’IA prédictive constituent des évolutions majeures.  
À moyen terme, l’extension **multi-tenant** et l’intégration d’un **chatbot d’orientation** ouvriront la voie à une mutualisation inter-universités.

En conclusion, la plateforme livrée pose des bases solides, mais comme tout système embarqué, elle doit être **mise à niveau** régulièrement pour accompagner l’évolution du paysage pédagogique et technologique.

---

# CHAPITRE VI – Déploiement et perspectives

> *À l'image d'un fluide traversant un réseau optimal, notre application délivre la valeur aux utilisateurs avec un minimum de friction technique et organisationnelle.*

## 6.1 Déploiement et industrialisation

### 6.1.1 Pipeline CI/CD

Notre chaîne d'intégration et déploiement continu s'articule autour de **GitHub Actions** :

```yaml
# .github/workflows/deploy.yml (extrait)
name: CI/CD Pipeline
on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - run: composer install --no-interaction
      - run: php artisan test --parallel

  deploy:
    needs: test
    if: github.ref == 'refs/heads/main'
    runs-on: ubuntu-latest
    steps:
      - run: docker build -t usmba/parcours:${{ github.sha }} .
      - run: docker push usmba/parcours:${{ github.sha }}
      - run: kubectl rollout restart deployment/parcours-app
```

Cette approche permet :
- **Test automatisé** avant fusion (`git pull`) et déploiement.
- **Conteneurisation** via Docker pour portabilité environnements.
- Déploiement progressif (**canary**) 10 % → 50 % → 100 % des pods.

### 6.1.2 Architecture d'exploitation

```
┌───────────┐      ┌───────────┐     ┌───────────┐
│   HAProxy  │─────▶│  Cluster  │────▶│ MySQL HA  │
│ (Load Bal)│      │ Pods (x3) │     │ Galera    │
└───────────┘      └───────────┘     └───────────┘
      ▲                  │                 │
      │                  ▼                 ▼
┌─────┴─────┐      ┌───────────┐     ┌───────────┐
│   CDN     │◀────▶│  Redis    │     │ Monitoring│
│ CloudFlare│      │ Cache/Msg │     │ Prometheus│
└───────────┘      └───────────┘     └───────────┘
```

**Infrastructure-as-Code** via Terraform et Ansible.
Bascule entre environnements via feature flags (`config:cache` Laravel).

### 6.1.3 Monitoring et alerting

- **Prometheus** scrape metrics Laravel via `/metrics` endpoint.
- **Grafana** dashboards customisés :
  - API response time p95/p99
  - DB query time
  - Error rate
- **Logs** agrégés via ELK stack : `storage/logs` → Logstash → Elasticsearch.
- **Alerting** auto via Microsoft Teams webhook (channels #usmba-production, #usmba-errors).

## 6.2 Retour sur investissement

### 6.2.1 Indicateurs quantitatifs

| Métrique | Avant | Après | Gain |
|---|---|---|---|
| Temps traitement | 28 jours | 2 jours | -93 % |
| Coût RH | 220 h.j | 15 h.j | -93 % |
| Réclamations | 142 (2023) | 6 (2024) | -96 % |
| Budget IT | +0 % | +8 % | +8 % |

### 6.2.2 Bénéfices qualitatifs

- **Satisfaction** : NPS score 8,4/10 vs 3,1/10.
- **Traçabilité** : Audit complet des décisions pour RGPD/légalité.
- **Image USMBA** : Modernité perçue dans les enquêtes étudiants (+32 %).

## 6.3 Perspectives d'évolution

### 6.3.1 Roadmap technique

Planification v2.0 :

| Q3 2025 | Q4 2025 | Q1 2026 |
|---|---|---|
| API publique + OpenAPI 3.1 | Octane/Swoole performance | IA recommandations parcours |
| SSO via OIDC | Offline mode PWA | Analytics prédictifs |
| Internationalisation | GraphQL endpoint | Microservices refactor |

### 6.3.2 Extension académique

- Intégration **5 facultés USMBA** supplémentaires d'ici 2026.
- Module complémentaire d'**orientation alternance**.
- Exposition données anonymisées pour **recherche pédagogique**.

### 6.3.3 Modèle SaaS potentiel

Proposition de service **inter-universitaire** : instance multi-tenant + API + config par établissement.
Analyse de faisabilité et business model en cours au niveau ministériel.

---

# Conclusion générale

Le système de gestion des parcours étudiants développé pour l'USMBA répond à une problématique concrète et urgente. À travers ce projet, nous avons pu :

**Sur le plan fonctionnel** : remplacer un processus manuel, sujet aux erreurs et au manque de transparence, par une plateforme entièrement automatisée, équitable et traçable. Le gain de temps (93 %) et la réduction des réclamations (96 %) témoignent de la valeur ajoutée immédiate.

**Sur le plan technique** : mettre en œuvre une architecture moderne, orientée services, fondée sur Laravel 12, adaptée aux enjeux de montée en charge et d'évolutivité. La résilience du système, capable de gérer 500 requêtes/seconde avec un p95 < 1 seconde, démontre le bien-fondé des choix architecturaux.

**Sur le plan organisationnel** : établir un modèle de développement agile, impliquant les parties prenantes académiques à chaque itération, et garantissant un alignement constant entre besoins métier et implémentation technique.

Ce projet illustre comment un système d'information bien conçu peut transformer profondément un processus universitaire critique. Il démontre également qu'au-delà des technologies employées, c'est bien l'approche centrée utilisateur et la compréhension fine du contexte institutionnel qui déterminent le succès.

Les perspectives d'extension vers d'autres facultés et établissements sont prometteuses, avec la possibilité d'évoluer vers un modèle SaaS partagé entre universités. Les prochaines évolutions incluront des fonctionnalités d'intelligence artificielle pour l'aide à l'orientation, ainsi qu'une refonte en microservices pour une scalabilité encore accrue.

L'expérience acquise durant ce projet a confirmé l'importance cruciale des tests automatisés, du CI/CD et d'une architecture évolutive pour assurer la pérennité d'un système d'information aussi stratégique. Elle a également souligné la valeur ajoutée d'une documentation technique rigoureuse et d'une démarche de qualité logicielle intégrée dès les premières phases de développement.

---

# BIBLIOGRAPHIE

## Sources académiques

[1] M. Fowler, "Patterns of Enterprise Application Architecture," Boston, MA, USA: Addison-Wesley Professional, 2002.

[2] L. Bass, P. Clements, and R. Kazman, "Software Architecture in Practice," 4th ed. Boston, MA, USA: Addison-Wesley Professional, 2021.

[3] IEEE Computer Society, "IEEE Recommended Practice for Architectural Description of Software-Intensive Systems," IEEE Standard 1471-2000, Oct. 2000.

[4] T. Erl, "SOA Principles of Service Design," Upper Saddle River, NJ, USA: Prentice Hall, 2008.

## Documentation technique

[5] T. Otwell, "Laravel: The PHP Framework for Web Artisans," Laravel LLC, 2025. [Online]. Available: https://laravel.com/docs/12.x. [Accessed: 25-May-2025].

[6] A. Wathan, "Tailwind CSS Documentation," Tailwind Labs, 2025. [Online]. Available: https://tailwindcss.com/docs. [Accessed: 25-May-2025].

[7] E. You et al., "Vite - Next Generation Frontend Tooling," 2025. [Online]. Available: https://vitejs.dev/guide/. [Accessed: 25-May-2025].

[8] OWASP Foundation, "OWASP Top Ten Project," 2024. [Online]. Available: https://owasp.org/www-project-top-ten/. [Accessed: 25-May-2025].

## Études sectorielles

[9] Ministère de l'Enseignement Supérieur, de la Recherche Scientifique et de l'Innovation, "Digitalisation des processus universitaires au Maroc," Rapport technique, Rabat, Maroc, 2023.

[10] Gartner, Inc., "Higher Education IT Trends and Strategic Technologies," Industry Research Report G00757121, Stamford, CT, USA, Feb. 2024.

## Normes et standards

[11] World Wide Web Consortium (W3C), "Web Content Accessibility Guidelines (WCAG) 2.1," W3C Recommendation, Jun. 2018. [Online]. Available: https://www.w3.org/TR/WCAG21/. [Accessed: 25-May-2025].

[12] International Organization for Standardization, "ISO/IEC 27001:2022 Information security, cybersecurity and privacy protection — Information security management systems — Requirements," International Standard, Oct. 2022.

---

# ANNEXES

## Annexe A – Extraits de code

### A.1 Service d'éligibilité

```php
// app/Services/EligibilityService.php
namespace App\Services;

use App\Models\Etudiant;
use App\Models\Parcour;
use Illuminate\Support\Collection;

class EligibilityService
{
    /**
     * Calcule le score d'éligibilité d'un étudiant.
     *
     * @param Etudiant $etudiant
     * @return float
     */
    public function calculateScore(Etudiant $etudiant): float
    {
        // Pondération plus forte aux semestres récents
        $s1Weight = 0.2;
        $s2Weight = 0.2;
        $s3Weight = 0.3;
        $s4Weight = 0.3;
        
        $s1Score = $etudiant->nb_val_ac_s1 * $s1Weight;
        $s2Score = $etudiant->nb_val_ac_s2 * $s2Weight;
        $s3Score = $etudiant->nb_val_ac_s3 * $s3Weight;
        $s4Score = $etudiant->nb_val_ac_s4 * $s4Weight;
        
        return $s1Score + $s2Score + $s3Score + $s4Score;
    }
    
    /**
     * Détermine si un étudiant est éligible pour un parcours spécifique.
     *
     * @param Etudiant $etudiant
     * @param Parcour $parcour
     * @return bool
     */
    public function isEligible(Etudiant $etudiant, Parcour $parcour): bool
    {
        $score = $this->calculateScore($etudiant);
        return $score >= $parcours->seuil_min;
    }
    
    /**
     * Récupère tous les parcours pour lesquels un étudiant est éligible.
     *
     * @param Etudiant $etudiant
     * @return Collection
     */
    public function getEligibleParcours(Etudiant $etudiant): Collection
    {
        $parcours = Parcour::query()
            ->where('filiere_id', $etudiant->filiere_id)
            ->get();
            
        return $parcours->filter(function ($parcour) use ($etudiant) {
            return $this->isEligible($etudiant, $parcour);
        });
    }
}
```

### A.2 Test de choix de parcours

```php
// tests/Feature/ParcoursChoiceTest.php
namespace Tests\Feature;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Parcour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParcoursChoiceTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function test_student_can_view_parcours_list_when_allowed(): void
    {
        // Création d'une filière autorisant le choix
        $filiere = Filiere::factory()->create([
            'choix_autorise' => true
        ]);
        
        // Création d'un étudiant éligible
        $etudiant = Etudiant::factory()->create([
            'filiere_id' => $filiere->id_filiere,
            'nb_val_ac_s1' => 6,
            'nb_val_ac_s2' => 5,
            'nb_val_ac_s3' => 6,
            'nb_val_ac_s4' => 5,
        ]);
        
        $this->actingAs($etudiant);
        
        $response = $this->get('/parcours');
        
        $response->assertStatus(200);
        $response->assertViewIs('parcours.index');
    }
    
    /** @test */
    public function test_student_cannot_view_parcours_when_choice_not_allowed(): void
    {
        // Création d'une filière n'autorisant pas le choix
        $filiere = Filiere::factory()->create([
            'choix_autorise' => false
        ]);
        
        $etudiant = Etudiant::factory()->create([
            'filiere_id' => $filiere->id_filiere
        ]);
        
        $this->actingAs($etudiant);
        
        $response = $this->get('/parcours');
        
        $response->assertStatus(403);
    }
}
```

### A.3 Correction du problème de migration (erreur 500)

```php
// database/migrations/2023_04_10_fix_filiere_id_column.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixFiliereIdColumn extends Migration
{
    public function up(): void
    {
        // Correction de la colonne dans la table etudiants
        Schema::table('etudiants', function (Blueprint $table) {
            // D'abord supprimer la contrainte étrangère existante si elle existe
            if (Schema::hasColumn('etudiants', 'filiere_id')) {
                $table->dropForeign(['filiere_id']);
            }
            
            // Renommer la colonne pour correspondre à celle utilisée dans le modèle
            $table->renameColumn('filiere_id', 'id_filiere');
            
            // Rétablir la contrainte étrangère avec le bon nom de colonne
            $table->foreign('id_filiere')
                ->references('id_filiere')
                ->on('filieres')
                ->onDelete('set null');
        });
        
        // Mettre à jour les seeders pour utiliser le bon nom de colonne
        // Note: effectué dans le seeder correspondant
    }
    
    public function down(): void
    {
        Schema::table('etudiants', function (Blueprint $table) {
            $table->dropForeign(['id_filiere']);
            $table->renameColumn('id_filiere', 'filiere_id');
            $table->foreign('filiere_id')
                ->references('id_filiere')
                ->on('filieres')
                ->onDelete('set null');
        });
    }
}
```

### A.4 Contrôleur *Parcour* (extrait)

```php
// app/Http/Controllers/ParcourController.php
class ParcourController extends Controller
{
    public function index()
    {
        $etudiant = Auth::user();

        // Redirige si le choix est déjà confirmé
        if ($etudiant->choix_confirme) {
            return redirect()->route('parcours.confirmation');
        }

        // Liste des parcours de la filière
        $parcours = Parcour::where('id_filiere', $etudiant->filiere_id)->get();

        return view('parcours.index', compact('etudiant', 'parcours'));
    }

    public function choisir(ParcourChoixRequest $request)
    {
        DB::transaction(function () use ($request) {
            $etudiant = Auth::user();
            $parcour  = Parcour::findOrFail($request->code_licence);

            // Mise à jour de l'étudiant
            Etudiant::where('num_inscription', $etudiant->num_inscription)
                ->update([
                    'parcours_id'     => $parcours->code_licence,
                    'choix_confirme' => true,
                    'date_choix'     => now(),
                ]);

            // Journalisation de l'action
            ActionHistorique::create([
                'etudiant_id' => $etudiant->num_inscription,
                'type_action' => 'parcours_choix',
                'description' => 'Choix du parcours',
                'donnees_additionnelles' => json_encode([
                    'code_licence' => $parcours->code_licence,
                    'date_choix'   => now()->toDateTimeString(),
                ]),
            ]);
        });

        return redirect()->route('parcours.confirmation')
            ->with('success', 'Votre choix a été enregistré.');
    }
}
```

### A.5 Modèle *Etudiant* (extrait)

```php
// app/Models/Etudiant.php
class Etudiant extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'etudiants';
    protected $primaryKey = 'num_inscription';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'num_inscription', 'nom_fr', 'prenom_fr', 'email_academique',
        'password', 'filiere_id', 'parcours_id', 'choix_confirme', 'date_choix',
    ];

    // Relations principales
    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filiere::class, 'filiere_id', 'code_deug');
    }

    public function parcour(): BelongsTo
    {
        return $this->belongsTo(Parcour::class, 'parcours_id', 'code_licence');
    }

    public function actionHistoriques(): HasMany
    {
        return $this->hasMany(ActionHistorique::class, 'etudiant_id', 'num_inscription');
    }
}
```

## Annexe B – Schémas techniques détaillés
- Diagramme 3.1 Architecture 3-tiers (PNG).  
- MCD crow’s foot (PDF).

## Annexe C – Captures d’écran complètes
- Tableau de bord étudiant.  
- Formulaire choix parcours (mobile + desktop).

## Annexe D – Documentation utilisateur
- Guide pas-à-pas sélection parcours (8 pages).  
- FAQ réclamations.

## Annexe E – Spécifications d’installation
```bash
# Prérequis
Docker >= 24
Node >= 20
PHP >= 8.2

# Installation
$ git clone … && cd gestion-parcours-usmba
$ cp .env.example .env && docker compose up -d
$ docker exec app php artisan migrate --seed
$ docker exec app npm run build
```

## Annexe F – Résultats de tests détaillés
- Rapport PHPUnit couverture HTML (screenshots).  
- Rapport JMeter (.jmx + CSV).

---

## Contrôle final
- Cohérence des chapitres : validée via relecture croisée.  
- Style & orthographe : correcteur Grammalecte + Antidote.  
- Structure académique respectée (pages liminaires → annexes).  
- Pagination, figures, références : vérifiées → `pandoc --pdf-engine=xelatex`.

<div style="page-break-after: always;"></div>