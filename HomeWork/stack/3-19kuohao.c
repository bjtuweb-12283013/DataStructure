#include <stdio.h>
#define INIT_SIZE 100
#define AUTO_INCREMENT 20

typedef struct 
{
	char *base;
	char *top;
}Stack;

Stack InitStack()
{
	Stack s;
	s.base = (char *)malloc(INIT_SIZE * sizeof(char));
	if (!s.base)
	{
		printf("MALLOC ERROR\n");
		exit(1);
	}
	s.top = s.base;
	return s;
}

char GetTop(Stack s)
{
	if (IsEmpty(s))
	{
		printf("EMPTY STACK\n");
		exit(1);
	}
	return *(s.top-1);
}

Stack Push(Stack s, char e)
{
	if (IsFull(s))
	{
		s.base = (char *)realloc(s.base, (INIT_SIZE+AUTO_INCREMENT)*sizeof(char));
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
		printf("%c ", *p);
		p++;
	}
	printf("\n");
}

int getLength(char *c)
{
	int i;
	for (i=0;c[i]!='\0';i++)
		;
	return i;
}

int main()
{
	Stack s;
	s = InitStack();
	char express[20];
	printf("Please input the bracket:\n");
	scanf("%s", express);
	int i;
	//int length = getLength(express);
	//for (i=0;i<length;i++)
	for (i=0;express[i]!='\0';i++)
	{
		switch(express[i])
		{
			case '(':s = Push(s, express[i]); break;
			case '[':s = Push(s, express[i]); break;
			case '{':s = Push(s, express[i]); break;
			case ')':if (GetTop(s)=='(')
						s = Pop(s);
					  else
					  {
					  	printf("NO\n");
					  	exit(1);
					  }
					break;
			case ']':if (GetTop(s)=='[')
						s = Pop(s);
					  else
					  {
					  	printf("NO\n");
					  	exit(1);
					  }
					  break;
			case '}':if (GetTop(s)=='{')
						s = Pop(s);
					  else
					  {
					  	printf("NO\n");
					  	exit(1);
					  }
					  break;
		}
	}
	if (!IsEmpty(s))
		printf("NO\n");
	else
		printf("YES\n");
	return 0;
}





















