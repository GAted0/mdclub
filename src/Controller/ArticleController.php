<?php

declare(strict_types=1);

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * 文章
 *
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends Controller
{
    /**
     * 文章列表页面
     *
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function pageIndex(Request $request, Response $response): Response
    {
        return $response;
    }

    /**
     * 文章详情页
     *
     * @param Request $request
     * @param Response $response
     * @param int $article_id
     *
     * @return Response
     */
    public function pageDetail(Request $request, Response $response, int $article_id): Response
    {
        return $response;
    }

    /**
     * 获取指定用户发表的文章列表
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $user_id
     * @return Response
     */
    public function getListByUserId(Request $request, Response $response, int $user_id): Response
    {
        return $response;
    }

    /**
     * 获取当前用户发表的文章列表
     *
     * @param  Request  $request
     * @param  Response $response
     * @return Response
     */
    public function getMyList(Request $request, Response $response): Response
    {
        return $response;
    }

    /**
     * 获取文章列表
     *
     * @param  Request  $request
     * @param  Response $response
     * @return Response
     */
    public function getList(Request $request, Response $response): Response
    {
        return $response;
    }

    /**
     * 发表文章
     *
     * @param  Request  $request
     * @param  Response $response
     * @return Response
     */
    public function create(Request $request, Response $response): Response
    {
        return $response;
    }

    /**
     * 获取指定文章详情
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $article_id
     * @return Response
     */
    public function get(Request $request, Response $response, int $article_id): Response
    {
        return $response;
    }

    /**
     * 更新指定文章
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $article_id
     * @return Response
     */
    public function update(Request $request, Response $response, int $article_id): Response
    {
        return $response;
    }

    /**
     * 删除指定文章
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $article_id
     * @return Response
     */
    public function delete(Request $request, Response $response, int $article_id): Response
    {
        return $response;
    }

    /**
     * 批量删除文章
     *
     * @param  Request  $request
     * @param  Response $response
     * @return Response
     */
    public function batchDelete(Request $request, Response $response): Response
    {
        return $response;
    }

    /**
     * 获取指定用户关注的文章列表
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $user_id
     * @return Response
     */
    public function getFollowing(Request $request, Response $response, int $user_id): Response
    {
        $following = $this->articleFollowService->getFollowing($user_id, true);

        return $this->success($response, $following);
    }

    /**
     * 获取当前用户关注的文章列表
     *
     * @param  Request $request
     * @param  Response $response
     * @return Response
     */
    public function getMyFollowing(Request $request, Response $response): Response
    {
        $userId = $this->roleService->userIdOrFail();
        $following = $this->articleFollowService->getFollowing($userId, true);

        return $this->success($response, $following);
    }

    /**
     * 获取指定文章的关注者
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $article_id
     * @return Response
     */
    public function getFollowers(Request $request, Response $response, int $article_id): Response
    {
        $followers = $this->articleFollowService->getFollowers($article_id, true);

        return $this->success($response, $followers);
    }

    /**
     * 当前用户关注指定文章
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $article_id
     * @return Response
     */
    public function addFollow(Request $request, Response $response, int $article_id): Response
    {
        $userId = $this->roleService->userIdOrFail();
        $this->articleFollowService->addFollow($userId, $article_id);
        $followerCount = $this->articleFollowService->getFollowerCount($article_id);

        return $this->success($response, ['follower_count' => $followerCount]);
    }

    /**
     * 当前用户取消关注指定文章
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $article_id
     * @return Response
     */
    public function deleteFollow(Request $request, Response $response, int $article_id): Response
    {
        $userId = $this->roleService->userIdOrFail();
        $this->articleFollowService->deleteFollow($userId, $article_id);
        $followerCount = $this->articleFollowService->getFollowerCount($article_id);

        return $this->success($response, ['follower_count' => $followerCount]);
    }

    /**
     * 添加投票
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $article_id
     * @return Response
     */
    public function addVote(Request $request, Response $response, int $article_id): Response
    {
        $userId = $this->roleService->userIdOrFail();
        $type = $request->getParsedBodyParam('type');

        $this->articleVoteService->addVote($userId, $article_id, $type);
        $voteCount = $this->articleVoteService->getVoteCount($article_id);

        return $this->success($response, ['vote_count' => $voteCount]);
    }

    /**
     * 删除投票
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $article_id
     * @return Response
     */
    public function deleteVote(Request $request, Response $response, int $article_id): Response
    {
        $userId = $this->roleService->userIdOrFail();
        $this->articleVoteService->deleteVote($userId, $article_id);
        $voteCount = $this->articleVoteService->getVoteCount($article_id);

        return $this->success($response, ['vote_count' => $voteCount]);
    }

    /**
     * 获取投票者
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $article_id
     * @return Response
     */
    public function getVoters(Request $request, Response $response, int $article_id): Response
    {
        $type = $request->getQueryParam('type');
        $voters = $this->articleVoteService->getVoters($article_id, $type, true);

        return $this->success($response, $voters);
    }

    /**
     * 获取指定文章下的评论列表
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $article_id
     * @return Response
     */
    public function getComments(Request $request, Response $response, int $article_id): Response
    {
        $list = $this->articleCommentService->getComments($article_id, true);

        return $this->success($response, $list);
    }

    /**
     * 在指定文章下发表评论
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $article_id
     * @return Response
     */
    public function addComment(Request $request, Response $response, int $article_id): Response
    {
        $content = $request->getParsedBodyParam('content');
        $commentId = $this->articleCommentService->addComment($article_id, $content);
        $comment = $this->commentService->get($commentId, true);

        return $this->success($response, $comment);
    }
}
