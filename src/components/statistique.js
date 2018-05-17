import * as React from 'react';


export default class Statistique extends React.Component {

	constructor (props) {
		super(props)
		this.state = {
			stats: [
				{id: 1, temps: '783', categorie: 'Science-Fiction', note: '6'},
			]
		}
	}

	render() {
		const {stats} = this.state;
		const content = <div className="Oeuvre">
			<h2> Statistiques </h2>
			{stats.map(stat => {
				return <tr key={stat.id}>
				<div className='stats-wrapper'>
	      			<p> Votre catégorie préférée est : {stat.categorie} </p>
	      			<p> Vous avez regardé des films pendant {stat.temps} heures </p>
	     			<p> Votre note moyenne est : {stat.note} </p>
     			</div>
     			</tr>
    		 })}
   		 </div>
	    return content;
	}
	
}