#include <stdio.h>
#define INIT_SIZE 100
#define AUTO_INCREMENT 20

typedef struct 
{
	int *base;
	int *top;
}Stack;

Stack InitStack()
{
	Stack s;
	s.base = (int *)malloc(INIT_SIZE * sizeof(int));
	if (!s.base)
	{
		printf("MALLOC ERROR\n");
		exit(1);
	}
	s.top = s.base;
	return s;
}

Stack CreateStack(int n)
{
	Stack s;
	s.base = (int *)malloc(INIT_SIZE * sizeof(int));
	if (!s.base)
	{
		printf("MALLOC ERROR\n");
		exit(1);
	}
	s.top = s.base;
	int i;
	printf("Input n data in order\n");
	for (i=0;i<n;i++)
	{
		scanf("%d",  s.top);
		s.top++;
	}
	return s;
}

int GetTop(Stack s)
{
	if (IsEmpty(s))
	{
		printf("EMPTY STACK\n");
		exit(1);
	}
	return *(s.top-1);
}

Stack Push(Stack s, int e)
{
	if (IsFull(s))
	{
		s.base = (int *)realloc(s.base, (INIT_SIZE+AUTO_INCREMENT)*sizeof(int));
		if (!s.base)
		{
			printf("REALLOC ERROR\n");
			exit(1);
		}
	}
	*(s.top) = e;
	s.top++;
	return s;
}

Stack Pop(Stack s)
{
	if (IsEmpty(s))
	{
		printf("EMPTY STACK\n");
		exit(1);
	}
	s.top--;
	return s;
}

int IsEmpty(Stack s)
{
	if (s.top == s.base)
		return 1;
	else 
		return 0;
}

int IsFull(Stack s)
{
	if (s.top-s.base>=INIT_SIZE-1)
		return 1;
	else 
		return 0;
}

void PrintStack(Stack s)
{
	if (IsEmpty(s))
	{
		printf("EMPTY STACK\n");
		exit(1);
	}
	int *p = s.base;
	while (p!=s.top)
	{
		printf("%d ", *p);
		p++;
	}
	printf("\n");
}

int main()
{
	Stack s;
	s = InitStack();
	char express[20];
	scanf("%s", express);
	int i;
	int op1, op2;
	for (i=0;express[i]!='\0';i++)
	{
		if (express[i]>='0' && express[i]<='9')
		{
			s = Push(s, express[i]-'0');
		}
		else if(express[i]=='+')
		{
			op2 = GetTop(s);
			s = Pop(s);
			op1 = GetTop(s);
			s = Pop(s);
			s = Push(s, (op1 + op2));
		}
		else if(express[i]=='-')
		{
			op2 = GetTop(s);
			s = Pop(s);
			op1 = GetTop(s);
			s = Pop(s);
			s = Push(s, (op1 - op2));
		}
		else if(express[i]=='*')
		{
			op2 = GetTop(s);
			s = Pop(s);
			op1 = GetTop(s);
			s = Pop(s);
			s = Push(s, (op1 * op2));
		}
		else if(express[i]=='/')
		{
			op2 = GetTop(s);
			s = Pop(s);
			op1 = GetTop(s);
			s = Pop(s);
			s = Push(s, (op1 / op2));
		}

	}

	printf("%d\n", *(s.base));
	printf("%d\n", GetTop(s));
}