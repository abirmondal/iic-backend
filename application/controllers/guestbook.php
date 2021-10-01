<?php 

class Guestbook extends CI_Controller
{
	
	public function index()
	{
		$query = "SELECT * FROM welcome_text ORDER BY date desc;";
		$data['messages'] = $this->db->query($query)->result();
		$this->load->view('guestbook/main', $data);
	}

	public function newmess()
	{
		ob_start();
		ob_end_clean();
		// print_r($_POST);
		$this->form_validation->set_rules('name', 'Name', 'required|trim|callback_nullword');
		$this->form_validation->set_rules('message', 'Message', 'required|trim|callback_nullword');
		$this->form_validation->set_message('required', 'This field is required.');

		if ($this->form_validation->run() == FALSE) {
			$x = json_encode($this->form_validation->error_array());
			echo($x);
		} else {
			$id = $this->idcreate();
			$query = "INSERT INTO welcome_text (id, name, message, date) VALUES ('".$id."', '".$_POST['name']."', '".$_POST['message']."', '".date('Y-m-d H:m:s', strtotime('now'))."')";
			if ($this->db->query($query)) {
				echo "1";
			} else {
				echo "Sorry! Message couldn't be posted. Please try again later.";
			}
		}
		
	}

	public function nullword($str)
	{
		if (strtoupper($str) == 'NULL' || strtoupper($str) == 'TEST') {
			$this->form_validation->set_message('nullword', 'The value of field can not be \''.$str.'\'.');
			return false;
		}
		else {
			return true;
		}
	}

	public function idcreate()
	{
		$id = 'm';
		$id .= date('d', strtotime('now'));
		$id .= $this->getmchar(date('n', strtotime('now')));
		$id .= date('y', strtotime('now'));
		$id .= $this->getmchar(date('g', strtotime('now')));
		$id .= date('is', strtotime('now'));

		return $id;
	}

	public function getmchar($m)
	{
		switch ($m) {
			
			case 1:
				return 'J';
				break;
			
			case 2:
				return 'F';
				break;
			
			case 3:
				return 'M';
				break;
			
			case 4:
				return 'A';
				break;
			
			case 5:
				return 'Y';
				break;
			
			case 6:
				return 'U';
				break;
			
			case 7:
				return 'L';
				break;
			
			case 8:
				return 'G';
				break;
			
			case 9:
				return 'S';
				break;
			
			case 10:
				return 'O';
				break;
			
			case 11:
				return 'N';
				break;
			
			case 12:
				return 'D';
				break;

			default:
				return 'Z';
				break;
		}
	}
}

 ?>
