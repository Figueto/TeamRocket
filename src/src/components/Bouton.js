import * as React from 'react';
import tick from '../Logos/tick.png'

export default class Bouton extends React.Component {

bouton() {
    console.log("ok")
		}

render() {
      const  content = <div className='Bouton'>
                <img src={tick} onClick={this.bouton()} alt='Image' width='40' height='40' />
              </div>
     return content
}
}
