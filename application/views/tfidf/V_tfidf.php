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
										<!--begin: Search Form-->
										<div class="mb-7">
											<div class="row align-items-center">
												<div class="col-lg-9 col-xl-8">
													<div class="row align-items-center">
														<div class="col-md-4 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Status:</label>
																<select class="form-control" id="kt_datatable_search_status">
																	<option value="">All</option>
																	<option value="1">Pending</option>
																	<option value="2">Delivered</option>
																	<option value="3">Canceled</option>
																	<option value="4">Success</option>
																	<option value="5">Info</option>
																	<option value="6">Danger</option>
																</select>
															</div>
														</div>
														<div class="col-md-4 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Type:</label>
																<select class="form-control" id="kt_datatable_search_type">
																	<option value="">All</option>
																	<option value="1">Online</option>
																	<option value="2">Retail</option>
																	<option value="3">Direct</option>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!--end: Search Form-->
										<!--begin: Datatable-->
										<table class="table">
											<thead class="thead-dark">
												<tr>
													<th scope="col">ID</th>
													<th scope="col">Query</th>
													<th scope="col">Created At</th>
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
												</tr>
											</tbody>
											<?php endforeach;?>
										</table>										
										<!--end: Datatable-->
									</div>
								</div>
								<!--end::Card-->
								<div class="row">
									<div class="col-lg-6">
										<!--begin::Card-->
										<div class="card card-custom">
											<div class="card-header">
												<div class="card-title">
													<h3 class="card-label">Term Frequency</h3>
												</div>
											</div>
											<div class="card-body">
												<p>Jumlah Kemunculan Kata Pada Setiap Data</p>
												<!--begin: Datatable-->
												<table class="table">
													<thead class="thead-dark">
														<tr>
															<th scope="col">ID</th>
															<th scope="col">ID Query</th>
															<th scope="col">Text</th>
															<th scope="col">TF</th>
														</tr>
													</thead>
													<tbody>
													<?php
														foreach($TF as $tfd):
															$id=$tfd['id_tf'];
															$idq=$tfd['id_query'];
															$text=$tfd['text'];
															$tfdata=$tfd['tf'];
													?>
														<tr>
															<td><?php echo $id;?></td>
															<td><?php echo $idq;?></td>
															<td><?php echo $text;?></td>
															<td><?php echo $tfdata;?></td>
														</tr>
													</tbody>
													<?php endforeach;?>
												</table>
												<?= $this->pagination->create_links(); ?>
												<!--end: Datatable-->
												<a href="#" class="btn btn-light-danger font-weight-bold" data-toggle="modal" data-target="#kt_datatable_modal_2">Launch Modal</a>
											</div>
										</div>
										<!--end::Card-->
									</div>

									<div class="col-lg-6">
										<!--begin::Card-->
										<div class="card card-custom">
											<div class="card-header">
												<div class="card-title">
													<h3 class="card-label">Normalize TF</h3>
												</div>
											</div>
											<div class="card-body">
												<p>Normalisasi TF</p>
												<!--begin: Datatable-->
												<table class="table">
													<thead class="thead-dark">
														<tr>
															<th scope="col">ID</th>
															<th scope="col">ID Query</th>
															<th scope="col">Text</th>
															<th scope="col">Result TF</th>
														</tr>
													</thead>
													<tbody>
													<?php
														foreach($NTF as $ntfd):
															$id=$ntfd['id_tfidf'];
															$idq=$ntfd['id_query'];
															$text=$ntfd['text'];
															$ntfdata=$ntfd['normalize_tf'];
													?>
														<tr>
															<td><?php echo $id;?></td>
															<td><?php echo $idq;?></td>
															<td><?php echo $text;?></td>
															<td><?php echo $ntfdata;?></td>
														</tr>
													</tbody>
													<?php endforeach;?>
												</table>
												<?= $this->pagination->create_links(); ?>
												<!--end: Datatable-->
												<a href="#" class="btn btn-light-success font-weight-bold" data-toggle="modal" data-target="#kt_datatable_modal_3">Launch Modal</a>
											</div>
										</div>
										<!--end::Card-->
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-6">
										<!--begin::Card-->
										<div class="card card-custom">
											<div class="card-header">
												<div class="card-title">
													<h3 class="card-label">IDF Data</h3>
												</div>
											</div>
											<div class="card-body">
												<p>Bobot Setiap Data</p>
												<!--begin: Datatable-->
												<table class="table">
													<thead class="thead-dark">
														<tr>
															<th scope="col">ID</th>
															<th scope="col">ID Query</th>
															<th scope="col">Kata</th>
															<th scope="col">Result IDF</th>
														</tr>
													</thead>
													<tbody>
													<?php
														foreach($idf as $idfd):
															$id=$idfd['id_idf'];
															$idq=$idfd['id_query'];
															$kata=$idfd['kata'];
															$idfkata=$idfd['idf'];
													?>
														<tr>
															<td><?php echo $id;?></td>
															<td><?php echo $idq;?></td>
															<td><?php echo $kata;?></td>
															<td><?php echo $idfkata;?></td>
														</tr>
													</tbody>
													<?php endforeach;?>
												</table>
												<?= $this->pagination->create_links(); ?>
												<!--end: Datatable-->
												<a href="#" class="btn btn-light-danger font-weight-bold" data-toggle="modal" data-target="#kt_datatable_modal_2">Launch Modal</a>
											</div>
										</div>
										<!--end::Card-->
									</div>

									<div class="col-lg-6">
										<!--begin::Card-->
										<div class="card card-custom">
											<div class="card-header">
												<div class="card-title">
													<h3 class="card-label">Term Query</h3>
												</div>
											</div>
											<div class="card-body">
												<p>Jumlah Kemunculan Query pada Setiap Data</p>
												<!--begin: Datatable-->
												<table class="table">
													<thead class="thead-dark">
														<tr>
															<th scope="col">ID</th>
															<th scope="col">ID Query</th>
															<th scope="col">Data</th>
															<th scope="col">Result</th>
														</tr>
													</thead>
													<tbody>
													<?php
														foreach($termq as $tq):
															$id=$tq['id_termquery'];
															$idq=$tq['id_query'];
															$doc=$tq['document'];
															$key=$tq['keyword'];
													?>
														<tr>
															<td><?php echo $id;?></td>
															<td><?php echo $idq;?></td>
															<td><?php echo $doc;?></td>
															<td><?php echo $key;?></td>
														</tr>
													</tbody>
													<?php endforeach;?>
												</table>
												<?= $this->pagination->create_links(); ?>
												<!--end: Datatable-->
												<a href="#" class="btn btn-light-success font-weight-bold" data-toggle="modal" data-target="#kt_datatable_modal_3">Launch Modal</a>
											</div>
										</div>
										<!--end::Card-->
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-6">
										<!--begin::Card-->
										<div class="card card-custom">
											<div class="card-header">
												<div class="card-title">
													<h3 class="card-label">TF-IDF Query</h3>
												</div>
											</div>
											<div class="card-body">
												<p>Bobot Query terhadap Data</p>
												<!--begin: Datatable-->
												<table class="table">
													<thead class="thead-dark">
														<tr>
															<th scope="col">ID</th>
															<th scope="col">ID Query</th>
															<th scope="col">Query Type</th>
															<th scope="col">Query</th>
															<th scope="col">Result</th>
														</tr>
													</thead>
													<tbody>
													<?php
														foreach($result_query as $rq):
															$id=$rq['id_hasil_query'];
															$idq=$rq['id_query'];
															$type=$rq['query_type'];
															$q=$rq['res_query'];
															$result=$rq['res_value'];
													?>
														<tr>
															<td><?php echo $id;?></td>
															<td><?php echo $idq;?></td>
															<td><?php echo $type;?></td>
															<td><?php echo $q;?></td>
															<td><?php echo $result;?></td>
														</tr>
													</tbody>
													<?php endforeach;?>
												</table>
												<?= $this->pagination->create_links(); ?>
												<!--end: Datatable-->
												<a href="#" class="btn btn-light-danger font-weight-bold" data-toggle="modal" data-target="#kt_datatable_modal_2">Launch Modal</a>
											</div>
										</div>
										<!--end::Card-->
									</div>
								</div>
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->