import Oeuvre from './oeuvre.js'
import * as React from 'react';
import Image from './Image.js'

export default class OeuvreTerminees extends Oeuvre  {

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
		const filmsVus = films.filter(i => i.vu == true);
		const  content = <div className='Oeuvre'>
			{filmsVus.map(film => {
				return <tr key={film.id}>
				<div className = "oeuvre-wrap">
				      <Oeuvre film={film} />
							<div className ='fonctions'>
							  <p className='note' onClick={this.changeNote.bind(this)}> {film.note} </p>
							</div>
			    </div>
			    </tr>
		 	})}
	    </div>

	    return content;
	}
}