#include <stdio.h>
#define INIT_SIZE 100

typedef struct{
    int *base;
    int *top;
}SqStack;

SqStack InitStack(SqStack s)
{
    s.base = (int *)malloc(INIT_SIZE * sizeof(int));
    s.top = s.base;
    return s;
}

SqStack Push(SqStack s, int e)
{
    if (s.top-s.base>=INIT_SIZE)
    {
        printf("Õ»Âú\n");
        exit(1);
    }
    *(s.top) = e;
    s.top ++;
    return s;
}

void PrintStack(SqStack s)
{
    if (s.base == s.top)
    {
         printf("¿ÕÕ»\n");
         exit(1);
    }
    int *p = s.top - 1;
    while (p!=s.base)
    {
        printf("%d  ", *p);
        p--;
    }
    printf("%d\n", *(s.base));
}

int main()
{
    SqStack s;
    s = InitStack(s);
    s = Push(s,1);
    s = Push(s,2);
    s = Push(s,3);

    PrintStack(s);
}
