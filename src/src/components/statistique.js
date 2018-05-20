import * as React from 'react';
import './css/statistique.css'
import ChartBar from './ChartBar.js'
import ChartPie from './ChartPie.js'
import ChartLine from './ChartLine.js'

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

		const content = <div className="infosStats">
				<div className='stats-wrapper'>
							<h2> Général </h2>
	      			<p className='Categorie'> Votre catégorie préférée est : {this.state.categorie} </p>
	      			<p className='temps'> Vous avez regardé des films pendant {this.state.temps} heures </p>
	     			  <p className='note' onClick={this.changeNote.bind(this)}> Votre note moyenne est : {this.state.note} </p>
     			</div>
					<div className='charts'>
							<ChartBar />
							<ChartPie />
							<ChartLine />
					</div>
   		 </div>
	    return content;
	}

}
