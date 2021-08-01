					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Details-->
								<div class="d-flex align-items-center flex-wrap mr-2">
									<!--begin::Title-->
									<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Menampilkan hasil <?php echo $syifa['keyword'] ?></h5>
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
										<table class="table" id="kt_datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Query</th>
                                                    <th scope="col">Nilai</th>
                                                </tr>
                                            </thead>
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
                        table.DataTable({
                            responsive: true,
                            ajax: {
                                url: HOST_URL + 'dashboard/hasil/<?php echo $id_query ?>',
                                type: 'POST',
                                data: {
                                    pagination: {
                                        perpage: 50,
                                    },
                                },
                            },
                            columns: [
                                {data: 'RecordID'},
                                {data: 'tweet'},
                                {data: 'value'},
                            ],

                        })
                    </script>