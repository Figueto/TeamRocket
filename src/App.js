import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';

function Oeuvre({titre = 'Inconnu', date = 'Inconnu', auteur = 'Inconnu', genre = 'Inconnu', pays = 'Inconnu', resume = 'Inconnu'}) {
  return (
    <div className="Oeuvre">
      <p> Le titre est = {titre} </p>
      <p> La date est = {date} </p>
      <p> L'auteur est = {auteur} </p>
      <p> Le genre est = {genre} </p>
      <p> Le pays est = {pays} </p>
      <p> Le resume est = {resume} </p>
    </div>
  )
}

class App extends Component {
  render() {
    return (
      <div className="App">
        <Oeuvre titre = "Titanic" date ="1997" auteur = "James Cameron" />
        <Oeuvre titre = "Scarface" auteur = "Brian De Palma" />
      </div>
    );
  }
}

export default App;
