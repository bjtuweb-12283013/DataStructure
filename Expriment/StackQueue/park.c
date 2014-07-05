#include <stdio.h>
#include <time.h>
#define QUEUESIZE 100

int n_list = 0;
int MAXSIZE = 0;

typedef struct
{
	int number;
	time_t intime;
 	time_t outtime;
}Car;

typedef struct 
{
	Car car;
	struct LNode *next;
}LNode, *LinkList;
LinkList tail;

typedef struct 
{
	Car elem[QUEUESIZE];
	int front;
	int rear;
}Queue;

LinkList InitLinkList()
{
	LinkList l;
	l = (LinkList)malloc(sizeof(LNode));
	tail = l;
	n_list = 0;
	return l;
}

LinkList InsertLinkList(LinkList l, Car mcar)
{
	LinkList s;
	s = (LinkList)malloc(sizeof(LNode));
	time(&(mcar.intime));
	s->car = mcar;
	tail->next = s;
	tail = s;
	n_list++;
	return l;
}

LinkList DeleteLinkList(LinkList l, int mnumber)
{
	LinkList p, q;
	p = l;
	q = p->next;
	int duration;
	while (q!=tail)
	{
		if((q->car).number==mnumber)
		{
			time(&((q->car).outtime));
			duration = difftime((q->car).outtime, (q->car).intime);
			p->next = q->next;
			free(q);
			break;
		}
		p = p->next;
		q = q->next;
	}
	if(q==tail)
	{
		time(&((q->car).outtime));
		duration = difftime((q->car).outtime, (q->car).intime);
		tail = p;
		free(q);
	}

	n_list--;

	printf("Car number  %d  has leaved just now, he has stayed ___%d___ seconds\n", mnumber, duration);
	return l;
}

int ListFull(LinkList l)
{
	if (n_list==MAXSIZE)
		return 1;
	return 0;
}

int ListEmpty(LinkList l)
{
	if (l==tail)
		return 1;
	return 0;
}

void PrintList(LinkList l)
{
	printf("-------------------------------------------\n");
	printf("In Park, ");
	LinkList p;
	p = l->next;
	while (p!=tail)
	{
		printf("number=%d  ", (p->car).number);
		p = p->next;
	}
	printf("number=%d  ", (tail->car).number);
	printf("\n");
}

Queue InitQueue()
{
	Queue q;
	q.front = q.rear = 0;
	return q;
}

Queue EnQueue(Queue q, Car mcar)
{
	q.elem[q.rear] = mcar;
	q.rear = (q.rear+1)%QUEUESIZE;
	return q;
}

Queue DeQueue(Queue q, Car *mcar)
{
	*mcar = q.elem[q.front];
	q.front = (q.front+1)%QUEUESIZE;
	return q;
}

int QueueEmpty(Queue q)
{
	if (q.front==q.rear)
		return 1;
	return 0;
}

int PrintQueue(Queue q)
{
	if (QueueEmpty(q))
	{
		printf("Wait Queue Empty\n");
		printf("-------------------------------------------\n\n");
		return 1;
	}

	printf("-------------------------------------------\n");
	printf("In Queue,  ");
	int p;
	for (p=q.front;p!=q.rear;p=(p+1)%QUEUESIZE)
	{
		printf("number=%d ", (q.elem[p]).number);
	}
	printf("\n\n");
}



int main()
{
	printf("Input MAXSIZE of the park\n");
	scanf("%d", &MAXSIZE);
	int mselect;
	int mnumber;
	Car car, mcar;
	LinkList l;
	l = InitLinkList();
	Queue q;
	q = InitQueue();
	while (1)
	{
		printf("Input 1 for a car IN, Input 2 for a car OUT\n");
		scanf("%d", &mselect);
		printf("Input the car NUMBER(int)\n");
		scanf("%d", &mnumber);
		car.number = mnumber;
		if (mselect==1)
		{
			q = EnQueue(q, car);
		//	PrintQueue(q);
			if (!ListFull(l))
			{
				q = DeQueue(q, &mcar);
				//PrintQueue(q);
				l = InsertLinkList(l, mcar);
				//PrintList(l);
			}
		}

		else if(mselect==2)
		{
			l = DeleteLinkList(l, mnumber);
			//PrintList(l);
			if (!QueueEmpty(q))
			{
				q = DeQueue(q, &mcar);
				//PrintQueue(q);
				l = InsertLinkList(l, mcar);
				//PrintList(l);
			}
		}
		else
		{
			printf("Input Error, Try again\n\n");
			continue;
		}
		PrintList(l);
		PrintQueue(q);
	}
	return 0;
}
