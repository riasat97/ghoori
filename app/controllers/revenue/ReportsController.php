<?php

class ReportsController extends RevenuesController {


	public function getReportDetails()
	{
    return $this->reportRepository->getReportDetails();
	}
    public function getReportView(){

        return $this->reportRepository->getReportView();
    }

    public function getReports(){
    return $this->reportRepository->getReports();
    }

}