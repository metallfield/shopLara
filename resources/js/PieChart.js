import {Pie} from "vue-chartjs";

export default {
    extends: Pie,
    props: ['names', 'counts', 'colors'],
    mounted()
    {
        this.renderChart({
            hoverBackgroundColor: "red",
            hoverBorderWidth: 10,
            labels: this.names,
            datasets: [
                {
                    label: 'Categories Products Count',
                    backgroundColor: this.colors,
                    data: this.counts
                }
            ]
        }, {responsive: true, maintainAspectRatio: false, hoverBorderWidth: 20})
    }
}
