					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Details-->
								<div class="d-flex align-items-center flex-wrap mr-2">
									<!--begin::Title-->
									<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Pencarian Informasi</h5>
									<!--end::Title-->
									<!--begin::Separator-->
									<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
									<!--end::Separator-->
								</div>
								<!--end::Details-->
							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Card-->
								<div class="card card-custom gutter-b">
									<div class="card-body">
										<!--begin: Datatable-->
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

												foreach($query->result_array() as $q):
													$id=$q['id_query'];
													$query=$q['keyword'];
													$date=$q['created_at'];
											?>
												<tr>
													<td><?php echo $id;?></td>
													<td><?php echo $query;?></td>
													<td><?php echo $date;?></td>
													<td>
														<a href="<?php echo base_url('dashboard/detail/'. $id) ?>" class="btn btn-sm btn-primary">Detail</a>
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