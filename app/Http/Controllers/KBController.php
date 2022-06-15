<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class KBController extends Controller
{
    public function ask_question(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/knowledgebase_service/ask_question',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'body'=>json_encode([
                'title' => $request->input('title'),
                'question' => $request->input('question'),
                'publisher_id' => $request->session()->get('id'),
                'category' => $request->input('category'),
                'date_created' => date('Y-m-d H:i:s')
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("knowledgebase")->with(['message' => 'Your question has been submitted successfully']);
    }

    public function get_questions(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->get('http://localhost:8080/helpdeskApi/rest/knowledgebase_service/get_questions',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ]
        ]);

        $result = json_decode((string)$credentials->getBody(),true);

        if ($result['question_data'] !== null )
        {
            $count = count($result['question_data']);

            $question_div = '';

            for($i = 0; $i < $count; $i++)
            {
                $total_count = $result['total_count'];
                $question_id = $result['question_data'][$i]['id'];
                $title = $result['question_data'][$i]['title'];
                $question = $result['question_data'][$i]['question'];
                $first_name = $result['question_data'][$i]['first_name'];
                $surname = $result['question_data'][$i]['surname'];
                $category = $result['question_data'][$i]['category'];
                $date_created = $result['question_data'][$i]['date_created'];

                $question_div .= '
                <script>
                $( "#get_question_id'.$question_id.'" ).load(function() {
                    $.ajax({
                        type: "POST",
                        url: "select_question_ans",
                        data: {question_id: '.$question_id.'},
                        success: function(data){
                            $("#get_answer_count'.$question_id.'").html(data);
                        }
                    });
                  });
                </script>
                <div class="card-body post-about" id="get_question_id'.$question_id.'">
                    <div class="mb-n-4">
                    <h6>'.$title.'</h6>
                    <span class="text-secondary small">'.$question.'</span>
                    <div class="row mt-4">
                        <div class="col-md-1 me-n-4"><div class="icon text-center text-success" style="background-color: #e0f7ec; padding: 4px 2px 0px 2px; border-radius: 5px"><i data-feather="user"></i></div></div>
                        <div class="col-md-3 ms-n-3">
                        <h5 class="small">'.$first_name.' '.$surname.'</h5>
                        <p class="small mt-n-2" style="font-size: 10px">'.$date_created.'</p>
                        </div>
                        <div class="col-md-8 text-end small">
                        <button class="btn btn-outline-light btn-sm text-secondary" type="submit" style="font-size: 12px" id="get_answer_count'.$question_id.'"> Answer(s)</button>
                        <button class="btn btn-light btn-sm text-secondary small" type="submit" style="font-size: 12px"><i class="fas fa-comment-alt"></i> Reply</button>
                        </div>
                    </div>
                    </div>
                </div>
                ';

                $request->session()->put('question_id',$question_id);
                $request->session()->put('total_count',$total_count);
                $request->session()->put('question_div',$question_div);
            }

            return view('pages.knowledgebase', ['page_name' => 'Knowledgebase']);
        }

        if ($result['question_data'] == null)
        {
            $question_div = 'No data...';

            $request->session()->put('question_div',$question_div);

            return view('pages.knowledgebase', ['page_name' => 'Knowledgebase']);
        }
    }

    public function select_question_ans(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $question_id = $request->input('question_id');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/knowledgebase_service/get_answer_count',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'question_id'=>$question_id
            ]
        ]);

        $result = json_decode((string)$credentials->getBody(),true);

        $total_count = $result['total_count'];

        return $total_count;
    }
}
