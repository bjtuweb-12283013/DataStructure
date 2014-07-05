#include <stdio.h>
#define MAX_VERTEX_NUM 10

typedef struct ArcNode
{
	int adjvex;
	struct ArcNode *nextarc;
}ArcNode;

typedef struct VNode
{
	char data;
	ArcNode *firstarc;
}VNode, AdjList[MAX_VERTEX_NUM];

typedef struct Graph
{
	AdjList vertices;
	int vexnum, arcnum;
	int kind;
}Graph;

typedef struct Queue
{
	int front;
	int rear;
	int data[MAX_VERTEX_NUM];
}Queue;

void InitQueue(Queue *Q)
{
	Q->front = Q->rear = 0;
}

void EnQueue(Queue *Q, int v)
{
	Q->data[Q->rear] = v;
	Q->rear = Q->rear + 1;
}

void DeQueue(Queue *Q, int *u)
{
	Q->rear--;
	*u = Q->data[Q->rear];
}

int QueueEmpty(Queue Q)
{
	if (Q.front==Q.rear)
		return 1;
	return 0;
}

int visited[MAX_VERTEX_NUM];

int FirstAdjVex(Graph G, int v)
{
	int w;
	if (G.vertices[v].firstarc==NULL)
		return 0;
	w = (G.vertices[v].firstarc)->adjvex;
	return w;
}

int NextAdjVex(Graph G, int v, int w)
{
	int i;
	ArcNode *p = G.vertices[v].firstarc;
	i = (G.vertices[v].firstarc)->adjvex;
	while (p->adjvex!=i)
		p = p->nextarc;
	if (p->nextarc==NULL)
		return 0;
	w = p->nextarc->adjvex;
	return w;
}

void DFS(Graph G, int v)
{
	printf("%c ",G.vertices[v].data);
	visited[v] = 1;
	int w;
	for (w=FirstAdjVex(G,v);w!=0;w=NextAdjVex(G,v,w))
		if (!visited[w])
			DFS(G,w);
}
/*
void BFSTraverse(Graph G)
{
	
}
*/


void BFS(Graph G, int v)
{
	Queue Q;
	InitQueue(&Q);
	visited[v] = 1;
	printf("%c ", G.vertices[v].data);
	EnQueue(&Q, v);
	int u ,w;
	while (!QueueEmpty(Q))
	{
		DeQueue(&Q, &u);
		for (w=FirstAdjVex(G,u);w!=0;w=NextAdjVex(G,u,w))
		{
			if (!visited[w])
			{
				visited[w] = 1;
				printf("%c ", G.vertices[w].data);
				EnQueue(&Q, w);
			}
		}
	}
}

void MyCreateGraph(Graph *G)
{

	(*G).vertices[0].data = '0';
	(*G).vertices[1].data = '1';
	(*G).vertices[2].data = '2';

	ArcNode *p = (ArcNode *)malloc(sizeof(ArcNode));
	((*G).vertices[0].firstarc) = p;
	p->adjvex = 1;
	p->nextarc = NULL;

	p = (ArcNode *)malloc(sizeof(ArcNode));
	((*G).vertices[1].firstarc) = p;
	p->adjvex = 2;
	p->nextarc = NULL;

	((*G).vertices[2].firstarc) = NULL;
}

int main()
{
	int i;
	for (i=0;i<MAX_VERTEX_NUM;i++)
		visited[i] = 0;
	Graph G;
	MyCreateGraph(&G);
	//DFS(G,0);
	BFS(G,0);
	return 0;
}