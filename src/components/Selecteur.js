import * as React from 'react';
import './css/Selecteur.css';
export default class Selecteur extends React.Component {

	render() {
    return <div className="Selecteur">
      <div className ='Filtre'> <p > Filtre:  </p> </div>
      <div className ='Genre'> <p > Genre </p> </div>
      <div className ='Media'> <p > Media </p> </div>
      <div className ='DatePlus'> <p > Date+ </p> </div>
      <div className ='DateMoins'> <p > Date- </p> </div>
    </div>
}
}
