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

}
