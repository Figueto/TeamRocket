import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';

function Oeuvre({titre = 'Inconnu', date = 'Inconnu', auteur = 'Inconnu', genre = 'Inconnu', pays = 'Inconnu', resume = 'Inconnu'}) {
  return (
    <div className="Oeuvre">
      <p> Le titre est = {titre} </p>
      <p> La date est = {date} </p>
      <p> Lauteur est = {auteur} </p>
      <p> Le genre est = {genre} </p>
      <p> Le pays est = {pays} </p>
      <p> Le resume est = {resume} </p>
    </div>
  )
}

function Statistique({temps = 'Inconnu', catégorie = 'Inconnu', Note = '_'}) {
  return (
    <div className="Oeuvre">
      <p> Vos catégories préférées sont = {catégorie} </p>
      <p> Le temps passé à visionner des oeuvre est = {temps} </p>
      <p> Votre note moyenne est = {Note} </p>
    </div>
  )
}

class App extends Component {
  render() {
    return (
      <div className="App">
      <h1>DashBoard Team Rocket </h1>
      <div id="searchbar">
          <form action="" class="formulaire">
             <input class="champ" type="text" value="Recherhez une oeuvre"/>
            <input class="bouton" type="button" value="Rechercher " />

                </form>
                </div>
      <div className= "Grille">
        <div className= "Colonne">
          <h2> Terminés </h2>
          <Oeuvre titre = "Titanic" date ="1997" auteur = "James Cameron" />
          <Oeuvre titre = "Titanic" date ="1997" auteur = "James Cameron" />
          <Oeuvre titre = "Titanic" date ="1997" auteur = "James Cameron" />
          <Oeuvre titre = "Titanic" date ="1997" auteur = "James Cameron" />
          <Oeuvre titre = "Titanic" date ="1997" auteur = "James Cameron" />
          <Oeuvre titre = "Titanic" date ="1997" auteur = "James Cameron" />
        </div>
        <div className= "Colonne">
          <h2> A voir </h2>
          <Oeuvre titre = "Scarface" auteur = "Brian De Palma" />
          <Oeuvre titre = "Scarface" auteur = "Brian De Palma" />
          <Oeuvre titre = "Scarface" auteur = "Brian De Palma" />
          <Oeuvre titre = "Scarface" auteur = "Brian De Palma" />
          <Oeuvre titre = "Scarface" auteur = "Brian De Palma" />
          <Oeuvre titre = "Scarface" auteur = "Brian De Palma" />
        </div>
        <div className= "Colonne">
          <h2> Statistiques </h2>
          <Statistique temps ="666h" catégorie = "Science-Fiction" Note = "6" />
        </div>
      </div>
    </div>
    );
  }
}

export default App;

//<div>
  //<h3> Visionnés </h3>
//  <Oeuvre titre = "Titanic" date ="1997" auteur = "James Cameron" />
//  </div>
/*     <div>
<h3> WatchList </h3>
<Oeuvre titre = "Scarface" auteur = "Brian De Palma" />
</div>
<div>
<h3> Statistiques </h3>
<Statistique temps ="666h" catégorie = "Science-Fiction" Note = "6" />
</div>*/
//</div>
