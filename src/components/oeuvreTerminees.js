import * as React from 'react';
import './oeuvre.css'
import Oeuvre from './oeuvre.js'



export default class OeuvreTerminees extends Oeuvre  {
	constructor (props) {
		super(props)
		this.state = {
			films: [
				{id: 1, titre: 'Titanic', date: '1997', auteur: 'James Cameron', genre: 'Drame', pays: 'USA', resume: 'Un bateau coule'},
				{id: 2, titre: 'Fast and Furious', date: 'Inconnu', auteur: 'Vin Diesel', genre: 'Vin Diesel', pays: 'USA', resume:'Vin Diesel'},
				{id: 3, titre: 'jaimelimaclefilm', date: '2018', auteur: 'Venceslas Biri', genre: 'Moijaimebien', pays: 'France', resume:'compilercesttricher'}
			]
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
