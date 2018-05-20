import * as React from 'react';
import {Bar} from'react-chartjs-2';
import './css/ChartBar.css'

export default class ChartBar extends React.Component {
  constructor(props){
    super(props);
    this.state = {
      chartData1:{
        labels: ['Janvier','Février','Mars','Avril','Mai','Juin'],
        datasets:[
          {
          label:'Heures de visionnage',
          data:[8,24,3,2,1,44],
          backgroundColor:'rgba(31, 117, 127, .3)'}]
    },
  }
}
	render() {
    return <div className="ChartBar">
    <h3> Durée de visionnage </h3>
      <Bar
	       data={this.state.chartData1}
	         width={95}
	         height={300}
	         options={{
		           maintainAspectRatio: false
	}}
/>
    </div>
}
}
