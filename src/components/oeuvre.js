import * as React from 'react';
import './oeuvre.css'


export default class Oeuvre extends React.Component {
	constructor (props) {
		super(props)
		this.state = {
			films: []
		}
	}

	render() {
		const {films} = this.state;
		const  content = <div className='Oeuvre'>
			{films.map(film => {
				return <tr key={film.id}>
				<div className = "oeuvre-wrap">
				      <h4> Le titre est = {film.titre} </h4>
				      <p className='Date'> La date est = {film.date} </p>
				      <div className = 'InfosOeuvre'>
					      <p className = 'Auteur'> Lauteur est = {film.auteur} </p>
					      <p className = 'Genre'> Le genre est = {film.genre} </p>
					      <p className = 'Pays'> Le pays est = {film.pays} </p>
					      <p className = 'Resume'> Le resume est = {film.resume} </p>
				      </div>
			    </div>
			    </tr>
		 	})}
	    </div>
	    return content;
	}

}
