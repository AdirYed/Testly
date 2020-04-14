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

  mounted() {
    this.renderChart(this.data, this.options);
  }
};
</script>
