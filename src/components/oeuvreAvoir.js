import Oeuvre from './oeuvre.js'
import * as React from 'react';
import Image from './Image.js'
import Bouton from './Bouton.js'

export default class OeuvreAvoir extends Oeuvre  {

	changeViewed() {
		super.setState({
	    	vu: true
	  	})
	}

	render() {
			const {films} = this.state;
			const filmsNVus = films.filter(i => i.vu == false);
			const content = <div className='Oeuvre'>
				{filmsNVus.map(film => {
					return <tr key={film.id}>
					<div className = "oeuvre-wrap">
					      <h4> {film.titre} </h4>
					      <p className='Date'> {film.date} </p>
					      <div className = 'InfosOeuvre'>
									<div className = 'InfosTexte'>
						      	<p className = 'Auteur'> Auteur : {film.auteur} </p>
						      	<p className = 'Genre'>  Genre : {film.genre} </p>
						      	<p className = 'Pays'> Origine :{film.pays} </p>
						      	<p className = 'Resume'> Resume : {film.resume} </p>
									</div>
									<div className ='InfosImage'>
										<Image/>
									</div>
					      </div>
								<div className ='Boutons'>
									<Bouton onClick={this.changeViewed.bind(this)} />
								</div>
				    </div>
				    </tr>
			 	})}
		    </div>

		    return content;
	}
	
}