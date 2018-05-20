import Oeuvre from './oeuvre.js'
import * as React from 'react'
import Image from './Image.js'
import './css/oeuvre.css'

export default class OeuvreTerminees extends Oeuvre  {
	constructor (props) {
		super(props)
		this.state = {
			films: [
				{id: 1, titre: 'Titanic', date: '1997', auteur: 'James Cameron', genre: 'Drame', pays: 'USA', resume: 'Un bateau coule'},
				{id: 2, titre: 'Fast and Furious', date: 'Inconnu', auteur: 'Vin Diesel', genre: 'Vin Diesel', pays: 'USA', resume:'Vin Diesel'},
				{id: 3, titre: 'jaimelimaclefilm', date: '2018', auteur: 'Venceslas Biri', genre: 'Moijaimebien', pays: 'France', resume:'compilercesttricher'},
				{id: 4, titre: 'jaimelimaclefilm', date: '2018', auteur: 'Venceslas Biri', genre: 'Moijaimebien', pays: 'France', resume:'compilercesttricher'}
			],
			note:5
		}
	}

		changeNote() {
			if(this.state.note==10){
				this.setState({
	    			note : 0
	  			})
			}
			else{
	  			this.setState({
	    			note : this.state.note+1
	  			})
	  		}
		}

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
								<div className ='fonctions'>
									<p className='note' onClick={this.changeNote.bind(this)}> {this.state.note} </p>
								</div>
				      </div>
			    </div>
			    </tr>
		 	})}
	    </div>
	    return content;
	}
}
