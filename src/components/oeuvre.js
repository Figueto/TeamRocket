import * as React from 'react';
import './css/oeuvre.css'
import Image from './Image.js'
import Bouton from './Bouton.js'



export default class Oeuvre extends React.Component {

	constructor (props) {
		super(props)
		this.state = {
			films: [
				{id: 1, titre: 'Titanic', date: '1997', auteur: 'James Cameron', genre: 'Drame', pays: 'USA', resume: 'Un bateau coule', vu: true},
				{id: 2, titre: 'Fast and Furious', date: '2001', auteur: 'Rob Cohen', genre: 'Action', pays: 'USA', resume:'Vin Diesel fait vroum', vu: false},
				{id: 3, titre: 'Le Parrain', date: '1972', auteur: 'Francis Ford Coppola', genre: 'Gangster', pays: 'USA', resume:'Histoire de la famille Corleone', vu: false},
				{id: 4, titre: 'Terminator', date: '1984', auteur: 'James Cameron', genre: 'Science Fiction', pays: 'USA', resume:'Schwarzy arrive nu sur Terre', vu: true},
				{id: 5, titre: 'Old Boy', date: '2003', auteur: 'Park Chan Wook', genre: 'Thriller', pays: 'Corée du Sud', resume:'Un homme veut se venger sévère', vu: false},
				{id: 6, titre: 'Steak', date: '2007', auteur: 'Quentin Dupieux', genre: 'Comédie', pays: 'France', resume:'Eric et Ramzy', vu: false},
				{id: 7, titre: 'Gran Torino', date: '2008', auteur: 'Clint Eastwood', genre: 'Drame', pays: 'USA', resume:'Un vieux raciste devient pote avec des corréens', vu: false},
				{id: 8, titre: 'Reservoir Dogs', date: '1992', auteur: 'Quentin Tarantino', genre: 'Gangster', pays: 'USA', resume:'Apprend tes couleurs de manière ludique !', vu: true}
			],
			note: 5
		}
	}

	render(){
		const content = <div>
							<h4> {this.props.film.titre} </h4>
				     		<p className='Date'> {this.props.film.date} </p>
				      		<div className = 'InfosOeuvre'>
								<div className = 'InfosTexte'>
						      		<p className = 'Auteur'> Auteur : {this.props.film.auteur} </p>
						      		<p className = 'Genre'>  Genre : {this.props.film.genre} </p>
						      		<p className = 'Pays'> Origine :{this.props.film.pays} </p>
						      		<p className = 'Resume'> Resume : {this.props.film.resume} </p>
								</div>
								<div className ='InfosImage'>
									<Image/>
								</div>
							</div>
				      </div>
	return content;
	}


}
