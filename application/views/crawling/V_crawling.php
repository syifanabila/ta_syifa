					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Details-->
								<div class="d-flex align-items-center flex-wrap mr-2">
									<!--begin::Title-->
									<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Data Crawling</h5>
									<!--end::Title-->
									<!--begin::Separator-->
									<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
									<!--end::Separator-->
									<!--begin::Search Form-->
									<div class="d-flex align-items-center" id="kt_subheader_search">
										<span class="text-dark-50 font-weight-bold" id="kt_subheader_total">250</span>
									</div>
									<!--end::Search Form-->
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
										<table class="table">
											<thead class="bg-primary table-hover table-bordered">
												<tr>
													<th scope="col">No.</th>
													<th scope="col">ID Tweet</th>
													<th scope="col">Created At</th>
													<th scope="col">Text Tweet</th>
												</tr>
											</thead>
											<tbody>
											<?php

												foreach($data as $i):
													$no=$i['id'];
													$id=$i['tweet_id'];
													$date=$i['created_at'];
													$text=$i['text'];

											?>
												<tr>
													<td><?php echo $no;?></td>
													<td><?php echo $id;?></td>
													<td><?php echo $date;?></td>
													<td><?php echo $text;?></td>
												</tr>
											
												<?php endforeach;?>
											</tbody>
										</table>
										<?= $this->pagination->create_links(); ?>
										<!--end: Datatable-->
									</div>
								</div>
								<!--end::Card-->
								<!--begin::Modal-->
								<div class="modal fade" id="kt_datatable_records_fetch_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Selected Records</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true"></span>
												</button>
											</div>
											<div class="modal-body">
												<div class="kt-scroll" data-scroll="true" data-height="200">
													<ul id="kt_apps_user_fetch_records_selected"></ul>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<!--end::Modal-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->