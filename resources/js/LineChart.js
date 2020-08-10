import {Line} from "vue-chartjs";

export default {
    extends: Line,
    props: ['chartData'],
    mounted(){
        this.renderChart({
            labels: this.chartData.num,
            datasets: [
                {
                    label: 'count of orders per month',
                    backgroundColor: '#f87979',
                    data: this.chartData.orders
                }
            ]
        }, {responsive: true, maintainAspectRatio: false})
    }
}
