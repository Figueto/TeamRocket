import * as React from 'react';
import titanic from '../Image/titanic.png'
import './css/Image.css'

export default class Image extends React.Component {

constructor(props){
    super(props);
}

  render() {
      	const  content = <div className='image'>
                  <img src={titanic} alt='Image' width='66' height='100' />
                </div>
       return content
  }
}
