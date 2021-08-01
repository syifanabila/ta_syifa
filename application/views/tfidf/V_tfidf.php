					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center flex-wrap mr-1">
									<!--begin::Page Heading-->
									<div class="d-flex align-items-baseline flex-wrap mr-5">
										<!--begin::Page Title-->
										<h5 class="text-dark font-weight-bold my-1 mr-5">Hasil Perhitungan TF-IDF</h5>
										<!--end::Page Title-->
									</div>
									<!--end::Page Heading-->
								</div>
								<!--end::Info-->
							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Card-->
								<div class="card card-custom gutter-b">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
											<h3 class="card-label">Inputan Query
											<span class="d-block text-muted pt-2 font-size-sm">Daftar Sampel Query</span></h3>
										</div>
									</div>
									<div class="card-body">
										
										<!--begin: Datatable-->
										<table class="table" id="kt_datatable">
											<thead>
												<tr>
													<th scope="col">ID</th>
													<th scope="col">Query</th>
													<th scope="col">Created At</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
											<?php

												foreach($data->result_array() as $q):
													$id=$q['id_query'];
													$query=$q['keyword'];
													$date=$q['created_at'];
											?>
												<tr>
													<td><?php echo $id;?></td>
													<td><?php echo $query;?></td>
													<td><?php echo $date;?></td>
													<td>
														<a href="<?php echo base_url('tfidf/detail/'. $id) ?>" class="btn btn-sm btn-primary">Detail</a>
													</td>
												</tr>
											</tbody>
											<?php endforeach;?>
										</table>										
										<!--end: Datatable-->
									</div>
								</div>
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->







					<script>

			var table = $('#kt_datatable');

			// begin first table
			table.DataTable();

		</script>
		<!--end::Page Scripts-->