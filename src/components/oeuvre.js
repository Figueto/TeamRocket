import * as React from 'react';
import './oeuvre.css'


export default class Oeuvre extends React.Component {

	render() {
		const {films} = this.state;
		const  content = <div className='Oeuvre'>
			{films.map(film => {
				return <tr key={film.id}>
				<div className = "oeuvre-wrap">
				      <h4> {film.titre} </h4>
				      <p className='Date'> {film.date} </p>
				      <div className = 'InfosOeuvre'>
					      <p className = 'Auteur'> Auteur : {film.auteur} </p>
					      <p className = 'Genre'>  Genre : {film.genre} </p>
					      <p className = 'Pays'> Origine :{film.pays} </p>
					      <p className = 'Resume'> Resume : {film.resume} </p>
				      </div>
			    </div>
			    </tr>
		 	})}
	    </div>
	    return content;
	}

}
