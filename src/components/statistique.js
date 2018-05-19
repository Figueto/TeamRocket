import * as React from 'react';
import './statistique.css'


export default class Statistique extends React.Component {

	constructor (props) {
		super(props)
		this.state = {
			temps: 783,
			categorie: 'Science-Fiction',
			note: 6
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
		const {stats} = this.state;
<<<<<<< HEAD
		const content = <div className="Oeuvre">
			<h2> Statistiques </h2>
=======
		const content = <div className="Statistiques">
			{stats.map(stat => {
				return <tr key={stat.id}>
>>>>>>> 590d273f95990e1fbad7f4daeaf59143ad6f687f
				<div className='stats-wrapper'>
	      			<p className='Categorie'> Votre catégorie préférée est : {this.state.categorie} </p>
	      			<p className='temps'> Vous avez regardé des films pendant {this.state.temps} heures </p>
	     			<p className='note' onClick={this.changeNote.bind(this)}> Votre note moyenne est : {this.state.note} </p>
     			</div>
   		 </div>
	    return content;
	}

}
