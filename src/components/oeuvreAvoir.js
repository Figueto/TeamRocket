import Oeuvre from './oeuvre.js'
import * as React from 'react';
import Image from './Image.js'
import Bouton from './Bouton.js'

export default class OeuvreAvoir extends Oeuvre  {



	changeViewed(props) {
		this.setState({
	    	vu: true
	  	})
	}

	render() {
		const {films} = this.state;
		const filmsNVus = films.filter(i => i.vu == false);
		const content = <div className='Oeuvre'>
			{filmsNVus.map(film => {
				return <tr key={film.id}>
				<div className = "oeuvre-wrap">
				      <Oeuvre film={film} />
							<div className ='Boutons'>
								<Bouton onClick={this.changeViewed.bind(this)} />
							</div>
			    </div>
			    </tr>
		 	})}
		   </div>
	   return content;
	}
	
}