import * as React from 'react';
import titanic from '../Image/titanic.png'
import './css/Image.css'

export default class Image extends React.Component {

  render() {
      	const  content = <div className='image'>
                  <img src={titanic} alt='Image' width='100' height='150' />
                </div>
       return content
  }
}
