import * as React from 'react';
import {Pie} from'react-chartjs-2';
import './css/ChartPie.css';


export default class ChartPie extends React.Component {
  constructor(props){
    super(props);
    this.state = {
    chartData2:{
      labels:['Science-Fiction', 'Aventure','Drame','Comédie','Thriller'],
      datasets:[
        {
        label:'Oeuvres visionnées',
        data:[5,12,4,27,8],
        backgroundColor:[
          '#2DE8FF',
          '#17747F',
          '#22AEBF',
          '#0B3A40',
          '#29D1E5'
        ]
      }]
    }
  }
}
	render() {
    return <div className="ChartPie">
    <h3>  Genres les plus visionnés </h3>
      <Pie
      data={this.state.chartData2}
      width={60}
      height={60}
/>
    </div>
}
}
