import * as React from 'react';
import {Bar,Line,Pie} from'react-chartjs-2';
import './ChartLine.css'

export default class ChartBar extends React.Component {
  constructor(props){
    super(props);
    this.state = {
      chartData3:{
        labels: ['Janvier','Février','Mars','Avril','Mai','Juin'],
        datasets: [
           {
             label: 'Note moyenne mensuelle',
             fill: false,
             lineTension: 0.3,
             backgroundColor: 'rgba(75,192,192,0.4)',
             borderColor: 'rgba(75,192,192,1)',
             borderCapStyle: 'butt',
             borderDash: [],
             borderDashOffset: 0.0,
             borderJoinStyle: 'miter',
             pointBorderColor: 'rgba(75,192,192,1)',
             pointBackgroundColor: '#fff',
             pointBorderWidth: 1,
             pointHoverRadius: 5,
             pointHoverBackgroundColor: 'rgba(75,192,192,1)',
             pointHoverBorderColor: 'rgba(220,220,220,1)',
             pointHoverBorderWidth: 2,
             pointRadius: 1,
             pointHitRadius: 10,
             data: [7, 6, 8,5, 4,9,]
           }
       ]
    },
  }
}
	render() {
    return <div className="ChartBar">
    <h3> Note Moyenne </h3>
    <Line data={this.state.chartData3} height={250}  />

    </div>
}
}
