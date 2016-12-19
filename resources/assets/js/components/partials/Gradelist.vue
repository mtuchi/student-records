<template lang="html">
<div class="col-md-6 form-inline">
	<select class="form-control" placeholder="Select Class">
		<option>Select Class</option>
		<option value="Pre">Pre</option>
		<option>I</option>
		<option>II</option>
		<option>III</option>
		<option>IV</option>
		<option>V</option>
		<option>VI</option>
		<option>VII</option>
	</select>
	<span v-if="errors" class="help-block">
	<strong>Display Errors</strong>
	</span>
	<select class="form-control" placeholder="Select Stream">
		<option>Select Stream</option>
		<option>A</option>
		<option>B</option>
	</select>
</div>
</template>
<script>
  export default {
    mounted() {
      console.log('Grade List');
    }
  }
</script>
<style lang="css">
</style>
