import * as React from 'react';
import './css/oeuvre.css'
import Image from './Image.js'
import Bouton from './Bouton.js'



export default class Oeuvre extends React.Component {

	render() {
		const {films} = this.state;
		const  content = <div className='Oeuvre'>
			{films.map(film => {
				return <tr key={film.id}>
				<div className = "oeuvre-wrap">
				      <p className='Title'> {film.titre} </p>
				      <div className = 'InfosOeuvre'>
							<div className ='InfosImage'>
								<Image/>
							</div>
								<div className = 'InfosTexte'>
								<p className='Date'> {film.date} </p>
					      	<p className = 'Auteur'> Auteur : {film.auteur} </p>
					      	<p className = 'Genre'>  Genre : {film.genre} </p>
					      	<p className = 'Pays'> Origine :{film.pays} </p>
					      	<p className = 'Resume'> Resume : {film.resume} </p>
								</div>
								<div className ='Boutons'>
									<Bouton/>
								</div>
				      </div>
			    	</div>
			    </tr>
		 	})}
	    </div>
	    return content;
	}

}
