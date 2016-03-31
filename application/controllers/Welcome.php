<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
		$this->load->view('clients');
	}
	
	public function getComments(){
		$this->load->model('mo_main');
		$result = $this->mo_main->getComments();
		
		echo json_encode($result);
	}
	
	public function addComment(){
		$author = $_POST['author'];
		$comment = $_POST['commenttext'];
		
		$this->load->model('mo_main');
		$this->mo_main->addNewComment($author, $comment);
	}
	
	public function GenerateNoticePDF() {
		$this->load->helper('tcpdf_helper');
$data['content'] = '<br /><br /><br />
					<p>[Date]</p><p>Ms. Joyce Michaels<br />
					CEO<br />
					ABC Company<br />
					15 Main St.<br />Sometown, MA 55555</p>
					<p>Dear Joyce,</p>
					<p align="justify">Please accept this letter as notice of my resignation from my position as staff accountant. My last day of employment will be June 22, 2012.</p>
					<p align="justify">I received an offer to serve as senior accountant of a Fortune 500 company, and after careful consideration, I realize that this opportunity is too exciting for me to decline.</p>
					<p align="justify">It has been a pleasure working with you and your team over the last three years. One of the highlights of my career was collaborating with you to automate ABC Company&rsquo;s accounting, financial and balance systems and setting up your accounting infrastructure. Your company is poised for continued growth and I wish you much success with your upcoming acquisition of XYZ Company.</p>
					<p align="justify">I would like to help with the transition of my accounting duties so that systems continue to function smoothly after my departure. I am available to help recruit and train my replacement, and I will make certain that all reporting and records are updated before my last day of work.</p>
					<p align="justify">Joyce, thank you again for the opportunity to work for ABC Company. I wish you and your staff all the best and I look forward to staying in touch with you. You can email me anytime at jones@somedomain.com or call me at 555-555-5555.</p>
					<p>Sincerely,</p>
					<p>&nbsp;</p>
					<p>Roberta Jones&nbsp;</p>';
		$data['content'] .= '
<label><b>(1) Juan Dela Cruz</b></label> 
<ul>
	<li> Monthly Rate : 25,000.00</li>
	<li>
		<table>
			<tr><td colspan="2"><b>Add :</b></td></tr>
			<tr>
				<td style="width: 200px;">Basic Pay @ 700/hr</td>
				<td style="text-align: right; width: 100px;">Php 5,000.00</td>
			</tr>
			<tr>
				<td style="width: 200px;">OT Pay (70hrs @ 35/hr)</td>
				<td style="text-align: right; width: 100px;">Php 2,450.00</td>
			</tr>
		</table>
		<table>
			<tr><td colspan="2"><b>Less :</b></td></tr>
			<tr>
				<td style="width: 200px;">Absences</td>
				<td style="text-align: right; width: 100px;">(Php 425.00)</td>
			</tr>
			<tr>
				<td style="width: 200px;">Tardiness/Undertime</td>
				<td style="text-align: right; width: 100px;">(Php 200.00)</td>
			</tr>
		</table>
		<table>
			<tr><td colspan="2"></td></tr>
			<tr>
				<td style="width: 200px;"><b>Total</b></td>
				<td style="text-align: right; width: 100px;"><b>Php 9,999.00</b></td>
			</tr>
		</table>
	</li>
</ul>
<br>
<label><b>(2) Pedro Dela Cruz</b></label>
<ul>
	<li>
		<table>
			<tr><td colspan="2"><b>Add :</b></td></tr>
			<tr>
				<td style="width: 200px;">Basic Pay @ 700/hr</td>
				<td style="text-align: right; width: 100px;">Php 5,000.00</td>
			</tr>
			<tr>
				<td style="width: 200px;">OT Pay (70hrs @ 35/hr)</td>
				<td style="text-align: right; width: 100px;">Php 2,450.00</td>
			</tr>
		</table>
		<table>
			<tr><td colspan="2"><b>Less :</b></td></tr>
			<tr>
				<td style="width: 200px;">Absences</td>
				<td style="text-align: right; width: 100px;">(Php 425.00)</td>
			</tr>
			<tr>
				<td style="width: 200px;">Tardiness/Undertime</td>
				<td style="text-align: right; width: 100px;">(Php 200.00)</td>
			</tr>
		</table>
		<table>
			<tr><td colspan="2"></td></tr>
			<tr>
				<td style="width: 200px;"><b>Total</b></td>
				<td style="text-align: right; width: 100px;"><b>Php 9,999.00</b></td>
			</tr>
		</table>
	</li>
</ul>
<br>
<label><b>(3) Flaviano Salcedo</b></label>
<ul>
	<li>
		<table>
			<tr><td colspan="2"><b>Add :</b></td></tr>
			<tr>
				<td style="width: 200px;">Basic Pay @ 700/hr</td>
				<td style="text-align: right; width: 100px;">Php 5,000.00</td>
			</tr>
			<tr>
				<td style="width: 200px;">OT Pay (70hrs @ 35/hr)</td>
				<td style="text-align: right; width: 100px;">Php 2,450.00</td>
			</tr>
		</table>
		<table>
			<tr><td colspan="2"><b>Less :</b></td></tr>
			<tr>
				<td style="width: 200px;">Absences</td>
				<td style="text-align: right; width: 100px;">(Php 425.00)</td>
			</tr>
			<tr>
				<td style="width: 200px;">Tardiness/Undertime</td>
				<td style="text-align: right; width: 100px;">(Php 200.00)</td>
			</tr>
		</table>
		<table>
			<tr><td colspan="2"></td></tr>
			<tr>
				<td style="width: 200px;"><b>Total</b></td>
				<td style="text-align: right; width: 100px;"><b>Php 9,999.00</b></td>
			</tr>
		</table>
	</li>
</ul>
<br>
<label><b>(4) Jose Domingo</b></label>
<ul>
	<li>
		<table>
			<tr><td colspan="2"><b>Add :</b></td></tr>
			<tr>
				<td style="width: 200px;">Basic Pay @ 700/hr</td>
				<td style="text-align: right; width: 100px;">Php 5,000.00</td>
			</tr>
			<tr>
				<td style="width: 200px;">OT Pay (70hrs @ 35/hr)</td>
				<td style="text-align: right; width: 100px;">Php 2,450.00</td>
			</tr>
		</table>
		
		<table>
			<tr><td colspan="2"><b>Less :</b></td></tr>
			<tr>
				<td style="width: 200px;">Absences</td>
				<td style="text-align: right; width: 100px;">(Php 425.00)</td>
			</tr>
			<tr>
				<td style="width: 200px;">Tardiness/Undertime</td>
				<td style="text-align: right; width: 100px;">(Php 200.00)</td>
			</tr>
		</table>
		<table>
			<tr><td colspan="2"></td></tr>
			<tr>
				<td style="width: 200px;"><b>Total</b></td>
				<td style="text-align: right; width: 100px;"><b>Php 9,999.00</b></td>
			</tr>
		</table>
	</li>
</ul>
<br>
<ul>
	<li>
		<table>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr>
				<td style="width: 200px;"></td>
				<td style="border-top: 1px solid black; width: 100px;">&nbsp;</td>
			</tr>
			<tr>
				<td style="width: 200px;">Sub Total</td>
				<td style="text-align: right; width: 100px;">Php 5,000.00</td>
			</tr>
			<tr>
				<td style="width: 200px;">Plus 12% VAT</td>
				<td style="text-align: right; width: 100px;">Php 2,450.00</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td></td><td style="border-top: 1px solid black;">&nbsp;</td></tr>
			<tr>
				<td style="width: 200px;"><b>Total Amount Due</b></td>
				<td style="text-align: right; width: 100px;"><b>Php 2,450.00</b></td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td></td><td style="border-top: 1px double black;">&nbsp;</td></tr>
		</table>
	</li>
</ul>



';
		$this->load->view('billpreview',$data);
	}
}
