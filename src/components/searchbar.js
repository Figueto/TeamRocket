import * as React from 'react';
import './css/searchbar.css'


export default class SearchBar extends React.Component {

	render() {
		const content = <div className="SearchBar">
        	<form class="formulaire">
          		<input class="champ" type="text" placeholder="Rechercher une oeuvre" />
          		<input class="bouton" type="button" value="Rechercher" />
        	</form>
    	</div>
	    return content;
	}

}
