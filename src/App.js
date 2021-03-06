import * as React from 'react';
import './App.css';
import user from './Logos/user.png'
import notification from './Logos/notification.png';
import Oeuvre from './components/oeuvre.js';
import OeuvreTerminees from './components/oeuvreTerminees.js';
import OeuvreAvoir from './components/oeuvreAvoir.js';
import Statistique from './components/statistique.js';
import SearchBar from './components/searchbar.js';
import Selecteur from './components/Selecteur.js';




class App extends React.Component {
  render() {
    return (
      <div className='App'>
        <div className='Header'>
            <h1>DashBoard Team Rocket </h1>
            <SearchBar />
            <div className='UserInterface'>
              <img className='User' src={user} alt='Image' width='50' height='50' />
              <img className='notification' src={notification} alt='Image' width='50' height='50' />
            </div>
        </div>
      <div className= "Grille">
        <div className= "Colonne">
          <div className= "ColonneHeader">
            <h2> Terminés </h2>
          </div>
          <Selecteur/>
          <div className= "ColonneContent">
            <OeuvreTerminees/>
          </div>
        </div>
        <div className= "Colonne">
          <div className= "ColonneHeader">
            <h2> A voir </h2>
          </div>
          <Selecteur/>
          <div className= "ColonneContent">
          <OeuvreAvoir />
          </div>
        </div>
        <div className= "Colonne">
        <div className= "ColonneHeader">
          <h2> Statistiques </h2>
        </div>
        <div className= "ColonneContent">
            <Statistique />
          </div>
        </div>
      </div>
      <div className="Footer">
        <p className= "NomSite"> @Site Dashboard Team Rocket Web Imac 2018 </p>
     </div>
    </div>
    );
  }
}

export default App;
