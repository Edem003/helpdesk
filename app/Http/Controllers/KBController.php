<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class KBController extends Controller
{
    public function ask_question(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $url = '';

        $request->validate([
            'image.*' => 'mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
        ]);

        if (request()->hasFile('attachment'))
        {
            $image = $request->file('attachment');
            $input['attachmentName'] = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'img\attachment';
            $image->move($imagePath, $input['attachmentName']);
            $url = str_replace('\\', '/', $imagePath.'/'.$input['attachmentName']);
        }

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
                'date_created' => date('Y-m-d H:i:s'),
                'attachment' => $url
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("knowledgebase")->with(['message' => 'Your question has been submitted successfully']);
    }

    public function paginate($items, $perPage = 4, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items, $offset, $perPage);
        return new LengthAwarePaginator($itemstoshow, $total, $perPage);
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
                <div class="card-body post-about">
                    <div class="mb-0">
                        <h6 class="small">'.$title.'</h6>
                        <span class="text-secondary small">'.$question.' [<span class="text-danger">'.$category.'</span>]</span>
                        <div class="row mt-4">
                            <div class="col-md-1 me-n-4"><div class="icon text-center text-success" style="background-color: #e0f7ec; padding: 4px 2px 0px 2px; border-radius: 5px"><i data-feather="user"></i></div></div>
                            <div class="col-md-5 ms-n-3">
                                <h5 class="small">'.$first_name.' '.$surname.'</h5>
                                <p class="small mt-n-2" style="font-size: 10px">'.$date_created.'</p>
                            </div>
                            <div class="col-md-6 text-end small">
                                <a class="btn btn-light btn-sm text-secondary small" type="button" href="knowledgebase-details/'.$question_id.'" style="font-size: 12px"><i class="fas fa-comment-alt"></i> Reply</a>
                            </div>
                        </div>
                    </div>
                </div>
                ';

                $request->session()->put('question_id',$question_id);
                $request->session()->put('total_count',$total_count);
                $request->session()->put('question_div',$question_div);
            }
        }

        if ($result['question_data'] == null)
        {
            $total_count = '0';

            $question_div = '
            <div class="card-body post-about">
                <div class="mt-n-2 mb-n-5">
                    No data...
                </div>
            </div>
            ';

            $request->session()->put('total_count',$total_count);
            $request->session()->put('question_div',$question_div);
        }

        $t_credentials = $http->get('http://localhost:8080/helpdeskApi/rest/knowledgebase_service/trending_questions',[
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

        $t_result = json_decode((string)$t_credentials->getBody(),true);

        if ($t_result['data'] !== null )
        {
            $count = count($t_result['data']);

            $trending_question_div = '';

            for($i = 0; $i < $count; $i++)
            {
                $question_id = $t_result['data'][$i]['question_id'];
                $title = $t_result['data'][$i]['title'];
                $total = $t_result['data'][$i]['total'];

                $trending_question_div .= '
                <a href="knowledgebase-details/'.$question_id.'">
                    <div class="row small mb-2">
                    <div class="col-xl-1 me-n-2">
                        <span><i class="fas fa-arrow-circle-right"></i></span>
                    </div>
                    <div class="col-xl-11">
                        <span class="text-secondary">'.$title.'</span>
                    </div>
                    </div>
                </a>
                ';

                $request->session()->put('trending_question_div',$trending_question_div);
            }
        }

        if ($t_result['data'] == null)
        {
            $total_count = '0';

            $trending_question_div = '
            <div class="card-body post-about">
                <div class="mt-n-2 mb-n-5">
                    No data...
                </div>
            </div>
            ';

            $request->session()->put('trending_question_div',$trending_question_div);
        }

        return view('pages.knowledgebase', ['page_name' => 'Knowledgebase']);
    }

    public function get_answer_details(Request $request, $id)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/knowledgebase_service/get_answer_details',[
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
                'question_id'=>$id
            ]
        ]);

        $result = json_decode((string)$credentials->getBody(),true);

        if ($result['question_data'] !== null )
        {
            $question_id = $result['question_data'][0]['id'];
            $title = $result['question_data'][0]['title'];
            $question = $result['question_data'][0]['question'];
            $first_name = $result['question_data'][0]['first_name'];
            $surname = $result['question_data'][0]['surname'];
            $category = $result['question_data'][0]['category'];
            $attachment = $result['question_data'][0]['attachment'];
            $date_created = $result['question_data'][0]['date_created'];

            if(!empty($attachment))
            {
                $question_div = '
                <h6>'.$title.'</h6>
                <span class="text-secondary small">'.$question.' [<span class="text-danger">'.$category.'</span>]</span>
                <br><br>
                <figure itemprop="associatedMedia" itemscope=""><a href="'.$attachment.'" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="'.$attachment.'" itemprop="thumbnail" alt="Image description"></a></figure>
                <div class="row mt-4">
                    <div class="col-md-1 me-n-4"><div class="icon text-center text-success" style="background-color: #e0f7ec; padding: 4px 2px 0px 2px; border-radius: 5px"><i data-feather="user"></i></div></div>
                    <div class="col-md-11 ms-n-3">
                        <h5 class="small">'.$first_name.' '.$surname.'</h5>
                        <p class="small mt-n-2" style="font-size: 10px">'.$date_created.'</p>
                    </div>
                </div>
                ';
            }

            if(empty($attachment))
            {
                $question_div = '
                <h6>'.$title.'</h6>
                <span class="text-secondary small">'.$question.' [<span class="text-danger">'.$category.'</span>]</span>
                <div class="row mt-4">
                    <div class="col-md-1 me-n-4"><div class="icon text-center text-success" style="background-color: #e0f7ec; padding: 4px 2px 0px 2px; border-radius: 5px"><i data-feather="user"></i></div></div>
                    <div class="col-md-11 ms-n-3">
                        <h5 class="small">'.$first_name.' '.$surname.'</h5>
                        <p class="small mt-n-2" style="font-size: 10px">'.$date_created.'</p>
                    </div>
                </div>
                ';
            }

            $request->session()->put('question_details_div',$question_div);

            $answers_div = '';

            if ($result['answer_data'] !== null )
            {

                $count = count($result['answer_data']);

                for($i = 0; $i < $count; $i++)
                {
                    $total_count = $result['total_answer_count'];
                    $answer_id = $result['answer_data'][$i]['id'];
                    $answer = $result['answer_data'][$i]['answer'];
                    $first_name = $result['answer_data'][$i]['first_name'];
                    $surname = $result['answer_data'][$i]['surname'];
                    $date_created = $result['answer_data'][$i]['created_date'];

                    $answers_div .= '
                    <div class="message my-message mb-3">
                        <div class="row mb-2">
                            <div class="col-xl-1 me-n-2">
                              <span><i class="fas fa-dot-circle small"></i></span>
                            </div>
                            <div class="col-xl-11 ms-n-2">
                                <span>'.$answer.'</span>
                                <h5 class="small mt-2">'.$first_name.' '.$surname.'</h5>
                                <p class="small mt-n-2" style="font-size: 10px">'.$date_created.'</p>
                            </div>
                        </div>  
                    </div>
                    
                    ';

                    $request->session()->put('total_answer_count',$total_count);
                    $request->session()->put('answers_div',$answers_div);
                    $id = $request->session()->put('question_id',$id);
                }
            }

            if ($result['answer_data'] == null )
            {
                $total_count = $result['total_answer_count'];
                $answers_div = 'No answers...';
                $request->session()->put('total_answer_count',$total_count);
                $request->session()->put('answers_div',$answers_div);
                $id = $request->session()->put('question_id',$id);
            }
        }

        return redirect("knowledgebase-details");
    }

    public function reply_question(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/knowledgebase_service/reply_question',[
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
                'question_id' => $request->session()->get('question_id'),
                'answer' => $request->input('answer'),
                'replier_id' => $request->session()->get('id'),
                'date_created' => date('Y-m-d H:i:s')
            ])
        ]);

        $response = $credentials->getBody();

        $id = $request->session()->get('question_id');

        return redirect("knowledgebase-details/".$id."")->with(['message' => 'Your answer has been submitted successfully']);
    }

    public function search_question(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/knowledgebase_service/search_question',[
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
                'search'=>$request->input('search')
            ]
        ]);

        $result = json_decode((string)$credentials->getBody(),true);

        if ($result['search_data'] !== null )
        {
            $count = count($result['search_data']);

            $search_div = '';

            for($i = 0; $i < $count; $i++)
            {
                $total_search = $result['total_search'];
                $question_id = $result['search_data'][$i]['id'];
                $title = $result['search_data'][$i]['title'];
                $question = $result['search_data'][$i]['question'];
                $first_name = $result['search_data'][$i]['first_name'];
                $surname = $result['search_data'][$i]['surname'];
                $category = $result['search_data'][$i]['category'];
                $date_created = $result['search_data'][$i]['date_created'];

                $search_div .= '
                <div class="card-body post-about">
                    <div class="mt-3">
                        <h6 class="small">'.$title.'</h6>
                        <span class="text-secondary small">'.$question.' [<span class="text-danger">'.$category.'</span>]</span>
                        <div class="row mt-4">
                            <div class="col-md-1 me-n-4"><div class="icon text-center text-success" style="background-color: #e0f7ec; padding: 4px 2px 0px 2px; border-radius: 5px"><i data-feather="user"></i></div></div>
                            <div class="col-md-5 ms-n-3">
                                <h5 class="small">'.$first_name.' '.$surname.'</h5>
                                <p class="small mt-n-2" style="font-size: 10px">'.$date_created.'</p>
                            </div>
                            <div class="col-md-6 text-end small">
                                <a class="btn btn-light btn-sm text-secondary small" type="button" href="knowledgebase-details/'.$question_id.'" style="font-size: 12px"><i class="fas fa-comment-alt"></i> Reply</a>
                            </div>
                        </div>
                    </div>
                </div>
                ';

                $request->session()->put('question_id',$question_id);
                $request->session()->put('total_search',$total_search);
                $request->session()->put('keyword',$request->input('search'));
                $request->session()->put('search_div',$search_div);
            }

            return redirect("knowledgebase-search");
        }

        if ($result['search_data'] == null)
        {
            $total_search = '0';

            $search_div = '
            <div class="card-body post-about">
                <div class="mt-n-2 mb-n-5">
                    No results...
                </div>
            </div>
            ';

            $request->session()->put('total_search',$total_search);
            $request->session()->put('keyword',$request->input('search'));
            $request->session()->put('search_div',$search_div);

            return redirect("knowledgebase-search");
        }

    }

    public function my_questions(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $user_id = $request->session()->get('id');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/knowledgebase_service/get_my_questions',[
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
                'user_id'=>$user_id
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
                <div class="card-body post-about">
                    <div class="mb-0">
                        <h6 class="small">'.$title.'</h6>
                        <span class="text-secondary small">'.$question.' [<span class="text-danger">'.$category.'</span>]</span>
                        <div class="row mt-4">
                            <div class="col-md-1 me-n-4"><div class="icon text-center text-success" style="background-color: #e0f7ec; padding: 4px 2px 0px 2px; border-radius: 5px"><i data-feather="user"></i></div></div>
                            <div class="col-md-5 ms-n-3">
                                <h5 class="small">'.$first_name.' '.$surname.'</h5>
                                <p class="small mt-n-2" style="font-size: 10px">'.$date_created.'</p>
                            </div>
                            <div class="col-md-6 text-end small">
                                <a class="btn btn-light btn-sm text-secondary small" type="button" href="knowledgebase-details/'.$question_id.'" style="font-size: 12px"><i class="fas fa-comment-alt"></i> Reply</a>
                            </div>
                        </div>
                    </div>
                </div>
                ';

                $request->session()->put('question_id',$question_id);
                $request->session()->put('my_total_count',$total_count);
                $request->session()->put('my_question_div',$question_div);
            }
        }

        if ($result['question_data'] == null)
        {
            $total_count = '0';

            $question_div = '
            <div class="card-body post-about">
                <div class="mt-n-2 mb-n-5">
                    No data...
                </div>
            </div>
            ';

            $request->session()->put('my_total_count',$total_count);
            $request->session()->put('my_question_div',$question_div);
        }

        $t_credentials = $http->get('http://localhost:8080/helpdeskApi/rest/knowledgebase_service/trending_questions',[
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

        $t_result = json_decode((string)$t_credentials->getBody(),true);

        if ($t_result['data'] !== null )
        {
            $count = count($t_result['data']);

            $trending_question_div = '';

            for($i = 0; $i < $count; $i++)
            {
                $question_id = $t_result['data'][$i]['question_id'];
                $title = $t_result['data'][$i]['title'];
                $total = $t_result['data'][$i]['total'];

                $trending_question_div .= '
                <a href="knowledgebase-details/'.$question_id.'">
                    <div class="row small mb-2">
                    <div class="col-xl-1 me-n-2">
                        <span><i class="fas fa-arrow-circle-right"></i></span>
                    </div>
                    <div class="col-xl-11">
                        <span class="text-secondary">'.$title.'</span>
                    </div>
                    </div>
                </a>
                ';

                $request->session()->put('trending_question_div',$trending_question_div);
            }
        }

        if ($t_result['data'] == null)
        {
            $total_count = '0';

            $trending_question_div = '
            <div class="card-body post-about">
                <div class="mt-n-2 mb-n-5">
                    No data...
                </div>
            </div>
            ';

            $request->session()->put('trending_question_div',$trending_question_div);
        }

        return redirect("knowledgebase-my-questions");
    }
}
