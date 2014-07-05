#include <stdio.h>
#define MAXSIZE 100 
#define HASHSIZE 11 
#define NULLKEY -32768 

typedef struct
{ 
	int *elem; 
	int count; 
}HashTable;

int m=0;
int count[11];
int InitHashTable(HashTable *H)
{
	int i;
	m=HASHSIZE;
	H->count=m;
	H->elem=(int *)malloc(m*sizeof(int));
	for(i=0;i<m;i++)
		H->elem[i]=NULLKEY; 
	return 1;
}

int Hash(int key)
{
	return key % m; 
}



void InsertHash(HashTable *H,int key)
{
	int addr = Hash(key); 
	while (H->elem[addr] != NULLKEY) 
	{
		count[addr]++;
		addr = (addr+1) % m; 
	}
	H->elem[addr] = key; 
}

int SearchHash(HashTable H,int key,int *addr)
{
	*addr = Hash(key);   
	while(H.elem[*addr] != key) 
	{
		*addr = (*addr+1) % m; 
		if (H.elem[*addr] == NULLKEY || *addr == Hash(key)) 
		return 0; 
	}
	return 1;
}

int main()
{
	int arr[HASHSIZE];
	int i,p,key,result;
	HashTable H;
	printf("Input %d keys:", HASHSIZE);


for(i=0;i<11;i++)
	count[i] = 0;


	for (i=0;i<HASHSIZE;i++)
		scanf("%d", &arr[i]);
	InitHashTable(&H);
	for(i=0;i<m;i++)
		InsertHash(&H,arr[i]);
	printf("Input the KEY you want to search:");
	scanf("%d", &key);
	result=SearchHash(H,key,&p);
	if (result)
		printf("Success  Search  %d     Address is %d\n",key,p);
	else
		printf("Search  %d     Fail\n",key);
	printf("\n");
	printf("The Whole HashTable:\n");
	for(i=0;i<m;i++)
	{
		key=arr[i];
		SearchHash(H,key,&p);
		printf("Search  %d     Address is %d\n",key,p);
	}

	printf("----------------------\n");
	for (i=0;i<11;i++)
		printf("%d ",count[i]);
	return 0;
}
