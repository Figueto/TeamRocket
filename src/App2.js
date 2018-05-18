import * as React from 'react';
import logo from './logo.svg';
import './App.css';
import PropTypes from 'prop-types';

import Oeuvre from './components/oeuvre.js';
import OeuvreTerminees from './components/oeuvreTerminees.js';
import OeuvreAvoir from './components/oeuvreAvoir.js';
import Statistique from './components/statistique.js';
import SearchBar from './components/searchbar.js';


class App extends React.Component {
  render() {
    return (
      <div className="App">
      <h1>DashBoard Team Rocket </h1>
      <SearchBar />
      <div className= "Grille">
        <div className= "Colonne">
          <h2> Terminés </h2>
          <OeuvreTerminees />
        </div>
        <div className= "Colonne">
          <h2> A voir </h2>
          <OeuvreAvoir />
        </div>
        <div className= "Colonne">
          <Statistique />
        </div>
      </div>
    </div>
    );
  }
}

export default App;
