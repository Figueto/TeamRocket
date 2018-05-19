import * as React from 'react';
import './oeuvre.css'
import Oeuvre from './oeuvre.js'

export default class OeuvreAvoir extends Oeuvre  {
	constructor (props) {
		super(props)
		this.state = {
			films: [
				{id: 1, titre: 'Titanic2', date: '1997', auteur: 'James Cameron', genre: 'Drame', pays: 'USA', resume: 'Un bateau coule'},
				{id: 2, titre: 'Fast and Furious2', date: 'Inconnu', auteur: 'Vin Diesel', genre: 'Vin Diesel', pays: 'USA', resume:'Vin Diesel'},
				{id: 3, titre: 'Fast and Furious2', date: 'Inconnu', auteur: 'Vin Diesel', genre: 'Vin Diesel', pays: 'USA', resume:'Vin Diesel'},
				{id: 4, titre: 'Fast and Furious2', date: 'Inconnu', auteur: 'Vin Diesel', genre: 'Vin Diesel', pays: 'USA', resume:'Vin Diesel'}
			]
		}
	}

	render() {
		const {films} = this.state;
		const  content = super.render();
	    return content;
	}

}
