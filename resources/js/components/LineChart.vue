<script>
import { Line } from "vue-chartjs";

export default {
    name: "line-chart",
    extends: Line,

    props: {
        data: {
            required: true,
            type: Object
        },
        options: {
            required: true,
            type: Object
        }
    },

    data() {
        return {
            gradient: null,
            gradient2: null
        };
    },

    mounted() {
        this.gradient = this.$refs.canvas
            .getContext("2d")
            .createLinearGradient(0, 0, 0, 450);

        this.gradient.addColorStop(0, "rgba(255, 0,0, 0.5)");
        this.gradient.addColorStop(0.5, "rgba(255, 0, 0, 0.25)");
        this.gradient.addColorStop(1, "rgba(255, 0, 0, 0)");

        this.renderChart(this.data, this.options);
    }
};
</script>
